import cv2 as cv

img = cv.imread('opencv_image.png', 0)
cv.imshow('Imagem', img)
if cv.waitKey(0)  == ord('s'):
    cv.waitKey(5000)
    cv.imwrite('opencv_image_gray.png', img)
cv.destroyAllWindows()