# coding: utf-8
import sys, os
sys.path.append(os.pardir)  # 为了导入父目录的文件而进行的设定
import numpy as np
import pickle # pkl文件
from dataset.mnist import load_mnist # 数据
from common.functions import sigmoid, softmax # 函数
#from PIL import Image

def get_data():
    # 训练数据，训练标签；测试数据，测试标签，normaize=True预处理 / 255
    (x_train, t_train), (x_test, t_test) = load_mnist(normalize=True, flatten=True, one_hot_label=False)
    return x_test, t_test

# 去掉预处理
# def apeal_data(x):
#     return x * 255

def init_network():
    with open("other/sample_weight.pkl", 'rb') as f:
        network = pickle.load(f)
    return network


def predict(network, x):
    W1, W2, W3 = network['W1'], network['W2'], network['W3']
    b1, b2, b3 = network['b1'], network['b2'], network['b3']

    a1 = np.dot(x, W1) + b1
    z1 = sigmoid(a1)
    a2 = np.dot(z1, W2) + b2
    z2 = sigmoid(a2)
    a3 = np.dot(z2, W3) + b3
    y = softmax(a3)

    return y

a = [0, 1]
b = [[4, 1],
     [2, 2]]
c = np.dot(a, b)
print(c)
exit()

x, t = get_data()
network = init_network()

batch_size = 100
accuracy_cnt = 0

# def img_show(img):
#     pil_img = Image.fromarray(np.uint8(img))
#     pil_img.show()

# img = apeal_data(x[0])
# img = img.reshape(28, 28)
# img_show(img)
# y = predict(network, x[0])
# print(y)
# print(t[0])
# exit()

for i in range(0, len(x), batch_size):
    x_batch = x[i:i+batch_size]
    y_batch = predict(network, x_batch)
    p = np.argmax(y_batch, axis=1)
    accuracy_cnt += np.sum(p == t[i:i+batch_size])
    #p = np.argmax(y) # 获取概率最高的元素的索引
    # if p == t[i]:
    #     accuracy_cnt += 1

print("Accuracy:" + str(float(accuracy_cnt) / len(x)))

def m(y, t):
    a = y - t
    b = a ** 2
    s = np.sum(b)
    x = 0.5 * s
    return x

def c(y, t):
    delta = 1e-7
    x = np.log(np.array([0.1,0.6,0.05]))
    a = np.log(y + delta)
    b = t * a
    c = np.sum(b)
    d = -c
    return d

t = [0,0,1,0,0,0,0,0,0,0]
y = [0.1,0.05,0.6,0.0,0.05,0.1,0.0,0.1,0.0,0.0]
a = c(np.array(y),np.array(t))
print(a)