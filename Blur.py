import cv2
i=cv2.imread("images/Blur.jpg")
iblur=cv2.GaussianBlur(i,(7,7),0)
cv2.imwrite('images/Blur.jpg', iblur)