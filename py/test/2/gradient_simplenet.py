# coding: utf-8
import sys, os
sys.path.append(os.pardir)  # 为了导入父目录中的文件而进行的设定
import numpy as np
from common.functions import softmax, cross_entropy_error
from common.gradient import numerical_gradient


class simpleNet:
    def __init__(self):
        self.W = np.random.randn(2,3)

    def predict(self, x):
        return np.dot(x, self.W)

    def loss(self, x, t):
        z = self.predict(x)
        y = softmax(z)
        loss = cross_entropy_error(y, t)

        return loss

print(np.random.choice(a=5, size=3, replace=False, p=[0.2, 0.1, 0.3, 0.4, 0.0]))

# x = np.array([0.6, 0.9])
# t = np.array([0, 0, 1])
#
# net = simpleNet()
#
# x = np.array([0.6, 0.9])
# t = np.array([0,0,1])
# f = lambda w: net.loss(x, t)
# dW = numerical_gradient(f, net.W)
#
# print(dW)
