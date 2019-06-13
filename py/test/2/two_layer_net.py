import sys, os
sys.path.append(os.pardir) # 引入父级
import numpy as np
from common.layers import *
from common.gradient import numerical_gradient
from collections import OrderedDict

class TwoLayerNet:
    # 初始化 参数：输入层神经元数、隐藏层神经元数、输出层神经元数、初始化高斯分布规模
    def __init__(self, input_size, hidden_size, output_size, weight_init_std = 0.01):
        # 初始化权重
        self.params = {}
        # randn(维度， 长度) 标准正态分布
        self.params['W1'] = weight_init_std * np.random.randn(input_size, hidden_size)# 第一层神经元
        # zeros(长度) 生成若干个零
        self.params['b1'] = np.zeros(hidden_size)# 第一层权重
        self.params['W2'] = weight_init_std * np.random.randn(hidden_size, output_size)
        self.params['b2'] = np.zeros(output_size)

        # 生成层
        self.layers = OrderedDict()
        self.layers['Affine1'] = Affine(self.params['W1'], self.params['b1'])
        self.layers['Relu1'] = Relu()
        self.layers['Affine2'] = Affine(self.params['W2'], self.params['b2'])

        self.lastLayer = SoftmaxWithLoss()

    # 识别推理 参数：图像数据
    def predict(self, x):
        for layer in self.layers.values():
            x = layer.forward(x)

        return x

    # 计算损失函数值 参数：图像数据、正确标签解
    def loss(self, x, t):
        y = self.predict(x)

        return self.lastLayer.forward(y, t)

    # 计算识别精度 参数：图像数据、正确标签解
    def accuracy(self, x, t):
        y = self.predict(x)
        y = np.argmax(y, axis=1)
        if t.ndim != 1 : t = np.argmax(t, axis=1)
        accuracy = np.sum(y == t) / float(x.shape[0])

        return accuracy

    # 计算权重参数梯度 参数：图像数据、正确标签解
    def numerical_gradient(self, x, t):
        loss_W = lambda W: self.loss(x, t)

        grads = {}
        grads["W1"] = numerical_gradient(loss_W, self.params['W1']) # 第一层权重梯度
        grads["b1"] = numerical_gradient(loss_W, self.params['b1']) # 第二层偏值梯度
        grads["W2"] = numerical_gradient(loss_W, self.params['W2'])
        grads["b2"] = numerical_gradient(loss_W, self.params['b2'])

        return grads

    # 计算权重参数梯度，同上，高速版
    def gradient(self, x, t):
        # forward
        self.loss(x, t)

        # backward
        dout = 1
        dout = self.lastLayer.backward(dout)

        layers = list(self.layers.values())
        layers.reverse()
        for layer in layers:
            dout = layer.backward(dout)

        grads = {}

        grads['W1'], grads['b1'] = self.layers['Affine1'].dW, self.layers['Affine1'].db
        grads['W2'], grads['b2'] = self.layers['Affine2'].dW, self.layers['Affine2'].db

        return grads
