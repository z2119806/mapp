import sys, os
sys.path.append(os.pardir) # 引入父级
from common.functions import *
from common.gradient import numerical_gradient

class TwoLayerNet:
    # 初始化 参数：输入层神经元数、隐藏层神经元数、输出层神经元数 ...
    def __init__(self, input_size, hidden_size, output_size, weight_init_std = 0.01):
        # 初始化权重
        self.params = {}
        # randn(维度， 长度) 标准正态分布
        self.params['W1'] = weight_init_std * np.random.randn(input_size, hidden_size)# 第一层神经元
        # zeros(长度) 生成若干个零
        self.params['b1'] = np.zeros(hidden_size)# 第一层权重
        self.params['W2'] = weight_init_std * np.random.randn(hidden_size, output_size)
        self.params['b2'] = np.zeros(output_size)

    # 识别推理 参数：图像数据
    def predict(self, x):
        W1, W2 = self.params['W1'], self.params['W2']
        b1, b2 = self.params['b1'], self.params['b2']

        a1 = np.dot(x, W1) + b1
        z1 = sigmoid(a1)
        a2 = np.dot(z1, W2) + b2
        y = softmax(a2)

        return y

    # 计算损失函数值 参数：图像数据、正确标签解
    def loss(self, x, t):
        y = self.predict(x)

        return cross_entropy_error(y, t)

    # 计算识别精度 参数：图像数据、正确标签解
    def accuracy(self, x, t):
        y = self.predict(x)
        y = np.argmax(y, axis = 1)
        t = np.argmax(t, axis = 1)

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
        W1, W2 = self.params['W1'], self.params['W2']
        b1, b2 = self.params['b1'], self.params['b2']
        grads = {}

        batch_num = x.shape[0]

        # forward
        a1 = np.dot(x, W1) + b1
        z1 = sigmoid(a1)
        a2 = np.dot(z1, W2) + b2
        y = softmax(a2)

        # backward
        dy = (y - t) / batch_num
        grads['W2'] = np.dot(z1.T, dy)
        grads['b2'] = np.sum(dy, axis=0)

        da1 = np.dot(dy, W2.T)
        dz1 = sigmoid_grad(a1) * da1
        grads['W1'] = np.dot(x.T, dz1)
        grads['b1'] = np.sum(dz1, axis=0)

        return grads
