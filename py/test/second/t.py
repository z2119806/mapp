import sys, os
sys.path.append(os.pardir)
from dataset.mnist import load_mnist
import numpy as np
from PIL import Image

def img_show(img):
    pil_img = Image.fromarray(np.uint8(img))
    pil_img.show()

#(x_train, t_train), (x_test, t_test) = load_mnist(flatten = True, normalize = False)
# img = x_train[0]
# label = t_train[0]
# print(label)
# print(img.shape)
# img = img.reshape(28, 28)
# print(img.shape)
# img_show(img)
(x_train, t_train), (x_test, t_test) = load_mnist(normalize = True, one_hot_label = True)
print(x_train.shape)
print(t_train.shape)
train_size = x_train.shape[0]
batch_size = 10
batch_mask = np.random.choice(train_size, batch_size)
x_batch = x_train[batch_mask]
t_batch = t_train[batch_mask]
# print(x_batch)
print(batch_mask)
