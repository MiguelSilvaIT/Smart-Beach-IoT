import cv2 as cv
import requests

camera = cv.VideoCapture(0, cv.CAP_DSHOW)

def send_file():
    r = requests.post('http://127.0.0.1/ProjetoTI/upload.php', files = {'imagem':  ('webcam.jpg', open('webcam.jpg', 'rb'), 'image/jpeg')})
    print(r.status_code, " -- ",r.text)

try:
    while True:
        
        if (r.status_code == 200):
            if (float(r.text) > 20.0):
                ret, image = camera.read()
                cv.imwrite('webcam.jpg', image)
                send_file()
            else:
        else:
        cv.waitKey(10000)
        
finally:
    print("")