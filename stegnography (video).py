# -- coding: utf-8 --
import cv2
import numpy as np
from scipy.stats import chisquare
import scipy.fftpack as fftpack
from skimage.measure import shannon_entropy

def detect_steganography(video_path):
    cap = cv2.VideoCapture(video_path)
    frame_count = 0
    lsb_distribution = []
    lsb_anomaly_detected = False
    dct_anomaly_detected = False
    entropy_anomaly_detected = False

    while cap.isOpened():
        ret, frame = cap.read()
        if not ret:
            break

        frame_count += 1
        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        lsb_frame = np.bitwise_and(gray_frame, 1)

        unique, counts = np.unique(lsb_frame, return_counts=True)
        lsb_distribution.append(counts)

        dct_transform = fftpack.dct(fftpack.dct(np.float32(gray_frame), axis=0, norm='ortho'), axis=1, norm='ortho')
        dct_mean = np.mean(dct_transform)
        if dct_mean > 50:
            dct_anomaly_detected = True

        entropy_value = shannon_entropy(gray_frame)
        if entropy_value > 7.5:
            entropy_anomaly_detected = True

    cap.release()

    # تحليل LSB
    if lsb_distribution:
        observed = np.sum(lsb_distribution, axis=0)
        expected = np.full_like(observed, np.mean(observed))
        chi_stat, p_value = chisquare(observed, expected)

        if p_value < 0.05:
            lsb_anomaly_detected = True

    # دمج النتائج
    if lsb_anomaly_detected or dct_anomaly_detected or entropy_anomaly_detected:
        print("⚠ Potential steganography detected")
    else:
        print("✅ No steganography detected")

if __name__ == "__main__":
    video_path = input("Enter the path to the video file: ")
    detect_steganography(video_path)
