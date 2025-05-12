import cv2
import numpy as np
import statistics
from keras.models import load_model
from keras import backend as K
import time
import mysql.connector
import threading
import os

# Connect to MySQL Database
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="neuronest"
)
cursor = conn.cursor()

# Global variables to track status
exam_active = False
program_running = True

# Utility functions (replacing imports from utils module)
def get_labels(dataset_name):
    """Gets emotion labels specific to dataset."""
    if dataset_name == 'fer2013':
        return {0: 'angry', 1: 'disgust', 2: 'fear', 3: 'happy',
                4: 'sad', 5: 'surprise', 6: 'neutral'}
    else:
        raise Exception('Invalid dataset name')

def apply_offsets(face_coordinates, offsets):
    """Applies offsets to face coordinates to get ROI."""
    x, y, width, height = face_coordinates
    x_off, y_off = offsets
    return (x - x_off, x + width + x_off, y - y_off, y + height + y_off)

def preprocess_input(x, v2=True):
    """Preprocess input for model."""
    x = x.astype('float32')
    x = x / 255.0
    if v2:
        x = x - 0.5
        x = x * 2.0
    return x

def save_emotion_to_db(emotion):
    """Function to save detected emotion into the database."""
    query = "INSERT INTO emotions (emotion) VALUES (%s)"
    cursor.execute(query, (emotion,))
    conn.commit()

def check_exam_status():
    """Function to continuously check a.txt file in a separate thread."""
    global exam_active
    global program_running
    
    while program_running:
        try:
            with open("a.txt", "r") as file:
                signal = file.read().strip()
                if signal == "1" and not exam_active:
                    exam_active = True
                    print("Exam is now active!")
                elif signal == "0" and exam_active:
                    exam_active = False
                    print("Exam is now paused.")
        except FileNotFoundError:
            pass  # Ignore if file not found
        
        time.sleep(1)  # Check every second

def predict():
    global exam_active
    global program_running
    
    # Start the background thread to check exam status
    status_thread = threading.Thread(target=check_exam_status, daemon=True)
    status_thread.start()
    
    # Parameters for loading data and images
    emotion_model_path = "C:\\xampp\\htdocs\\Neuronest\\admin\\courses\\ML\\models\\emotion_model.hdf5"
    emotion_labels = get_labels('fer2013')

    frame_window = 10
    emotion_offsets = (20, 40)

    # Check if model file exists
    if not os.path.exists(emotion_model_path):
        print(f"Error: Model file not found at {emotion_model_path}")
        program_running = False
        return "error_model_not_found"

    face_cascade_path = 'C:\\xampp\\htdocs\\Neuronest\\admin\\courses\\ML\\models\\haarcascade_frontalface_default.xml'
    
    # Check if cascade file exists
    if not os.path.exists(face_cascade_path):
        print(f"Error: Cascade file not found at {face_cascade_path}")
        program_running = False
        return "error_cascade_not_found"
        
    face_cascade = cv2.CascadeClassifier(face_cascade_path)
    emotion_classifier = load_model(emotion_model_path)
    emotion_target_size = emotion_classifier.input_shape[1:3]

    emotion_window = []
    
    # Initialize video capture but don't start processing until exam is active
    cap = cv2.VideoCapture(0)
    
    if not cap.isOpened():
        print("Error: Could not open webcam")
        program_running = False
        return "error_webcam_not_available"

    start_time = time.time()
    question_counter = 0
    max_questions = 10
    waiting_for_start = True
    
    print("Waiting for activity to start... Check a.txt for signal '1'")
    
    while program_running:
        # Wait for exam to become active if not already
        if waiting_for_start and not exam_active:
            time.sleep(0.5)
            continue
        elif waiting_for_start and exam_active:
            waiting_for_start = False
            print("activity started!")
            start_time = time.time()  # Reset timer when exam starts
        
        # If exam becomes inactive, pause processing and wait for it to become active again
        if not exam_active:
            print("activity paused. Waiting for activity to resume...")
            waiting_for_start = True
            time.sleep(1)
            continue
            
        # Process emotions when exam is active
        if cap.isOpened() and question_counter < max_questions:
            ret, bgr_image = cap.read()
            if not ret:
                time.sleep(0.1)
                continue

            gray_image = cv2.cvtColor(bgr_image, cv2.COLOR_BGR2GRAY)
            rgb_image = cv2.cvtColor(bgr_image, cv2.COLOR_BGR2RGB)

            faces = face_cascade.detectMultiScale(gray_image, scaleFactor=1.1, minNeighbors=5,
                                                  minSize=(30, 30), flags=cv2.CASCADE_SCALE_IMAGE)

            for face_coordinates in faces:
                x1, x2, y1, y2 = apply_offsets(face_coordinates, emotion_offsets)
                # Ensure coordinates are within image boundaries
                x1 = max(0, x1)
                y1 = max(0, y1)
                x2 = min(bgr_image.shape[1], x2)
                y2 = min(bgr_image.shape[0], y2)
                
                # Skip if face region is invalid
                if x2 <= x1 or y2 <= y1:
                    continue
                    
                gray_face = gray_image[y1:y2, x1:x2]
                try:
                    gray_face = cv2.resize(gray_face, (emotion_target_size))
                except:
                    continue

                gray_face = preprocess_input(gray_face, True)
                gray_face = np.expand_dims(gray_face, 0)
                gray_face = np.expand_dims(gray_face, -1)
                emotion_prediction = emotion_classifier.predict(gray_face)
                emotion_probability = np.max(emotion_prediction)
                emotion_label_arg = np.argmax(emotion_prediction)
                emotion_text = emotion_labels[emotion_label_arg]
                save_emotion_to_db(emotion_text)
                emotion_window.append(emotion_text)

                if len(emotion_window) > frame_window:
                    emotion_window.pop(0)

            # Time check for 1 minute per question
            if time.time() - start_time > 60:
                question_counter += 1
                start_time = time.time()
                print(f"Question {question_counter} answered.")
                
                # Check if all questions have been processed
                if question_counter >= max_questions:
                    print("All activities processed!")
                    program_running = False
                    break

            # Manual exit option
            if cv2.waitKey(1) & 0xFF == ord('q'):
                print("Manual exit triggered. Exiting...")
                program_running = False
                break
        else:
            # Exit if we reached the maximum questions or the camera is closed
            if question_counter >= max_questions:
                print("All questions processed!")
            else:
                print("Camera is no longer available.")
            program_running = False
            break

    # Clean up
    if cap.isOpened():
        cap.release()
    cv2.destroyAllWindows()
    K.clear_session()

    try:
        emotion_mode = statistics.mode(emotion_window) if emotion_window else "neutral"
    except statistics.StatisticsError:
        # Handle case when there are multiple modes
        if emotion_window:
            # Count occurrences of each emotion
            emotion_counts = {}
            for emotion in emotion_window:
                if emotion in emotion_counts:
                    emotion_counts[emotion] += 1
                else:
                    emotion_counts[emotion] = 1
            # Find the most frequent emotions
            max_count = max(emotion_counts.values())
            most_frequent = [e for e, c in emotion_counts.items() if c == max_count]
            emotion_mode = most_frequent[0]  # Take the first one if multiple
        else:
            emotion_mode = "neutral"
    
    return emotion_mode

# Main execution
try:
    out = predict()
    print(f"Final detected emotion: {out}")

    with open("output.txt", "w") as file:
        file.write(str(out))
except Exception as e:
    print(f"An error occurred: {str(e)}")
    with open("output.txt", "w") as file:
        file.write(f"error: {str(e)}")
finally:
    # Make sure to close the database connection
    if 'conn' in locals() and conn.is_connected():
        cursor.close()
        conn.close()
        print("Database connection closed.")