import cv2
print("Hello world!")
i=cv2.imread("images/bw.jpg")
igrey=cv2.cvtColor(i,cv2.COLOR_BGR2GRAY)
cv2.imwrite('images/bw.jpg', igrey)