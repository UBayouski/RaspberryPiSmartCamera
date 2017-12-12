import cv2
import ntpath
import os
import sys

if __name__ == '__main__' and len(sys.argv) > 1:
    image_path = sys.argv[1]
    head, tail = ntpath.split(image_path)
    image_file = tail or ntpath.basename(head)
    image_file_name = ntpath.splitext(image_file)[0]
    # Root path of current script
    root_path = sys.path[0]

    x = 0
    y = 0
    cascPath = '{}/haarcascade_frontalface_default.xml'.format(root_path)
    faceCascade = cv2.CascadeClassifier(cascPath)
    font = cv2.FONT_HERSHEY_SIMPLEX

    image = cv2.imread(image_path)

    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    faces = faceCascade.detectMultiScale(
        gray,
        scaleFactor = 1.1,
        minNeighbors = 5,
        minSize = (50, 50),
        # when the values are smallers, the face to detect can be smaller
        # In OpenCV 3 please use cv2.HAAR_SCALE_IMAGE
        flags = cv2.cv.CV_HAAR_SCALE_IMAGE)

    # Draw a rectangle around faces found
    for (x, y, w, h) in faces:
        # To draw a rectangle this are the parameters
        # cv2.rectangle(img,(x1,y1),(x2,y2),(255,0,0),2)
        # img is the image variable, it can be "frame" like in this example
        # x1,y1 ---------
        # |              |
        # |              |
        # |              |
        # -------------x2,y2
        # (255,0,0) are (R,G,B)
        # the last 2 is the thickness of the line 1 to 3 thin to gross
        cv2.rectangle(image, (x, y), (x + w, y + h), (0, 255, 100), 1)

        # To write the x,y on the middle of the rectangle.
        stringxy = '+ %s, %s' % (x, y) # To prepare the string with the xy values to be used with the cv2.putText function
        # In the case we want to put Xxvalue,Yyvalue we can use the following line removing #.
        # stringaxy='X%s, Y%s' % (x, y) 
        cv2.putText(image, stringxy, (x + w / 2, y + h / 2), font, 1, (0, 0, 255), 1)

    # Saves processed image, you can choose different path depending on your needs
    cv2.imwrite('{}/{}_output.png'.format(root_path, image_file_name), image)

    # When everything is done, release everything if job is finished
    cv2.destroyAllWindows()
 
