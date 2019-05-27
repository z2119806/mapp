import numpy as np

# 恒等函数-将输入按原样输出-回归问题
def identity_function(x):
    return x

# 激活函数-解决二分类问题，曲线分类
def sigmiod(x):
    return 1 / (1 + np.exp(-x))

# 分类问题用
def softmax(a):
    c = np.max(a) # 防止溢出-减去最大值
    exp_a = np.exp(a - c)
    sum_exp_a = np.sum(exp_a)
    y = exp_a / sum_exp_a

    # 即y(k) = exp(a(k)) / sigma(exp(a(i))) i = 1
    # k输入信号的个数，a输入信号值，每个值除以e(a(i))的和
    # 类似循环i每个
    # 最后结果的和等于1，任何集合除以它们的和的和相加等于1，计算概率可以用这个函数
    return y

def init_network():
    network = {}
    network['W1'] = np.array([[0.1, 0.3, 0.5], [0.2, 0.4, 0.6]])
    network['b1'] = np.array([0.1, 0.2, 0.3])
    network['W2'] = np.array([[0.1, 0.4], [0.2, 0.5], [0.3, 0.6]])
    network['b2'] = np.array([0.1, 0.2])

    return network

def forward(network, x):
    W1, W2, W3 = network['W1'], network['W2']
    b1, b2, b3 = network['b1'], network['b2']

    # dot矩阵运算
    a1 = np.dot(x, W1) + b1
    z1 = sigmiod(a1)
    a2 = np.dot(z1, W2) + b2
    z2 = sigmiod(a2)
    a3 = np.dot(z2, W3) + b3

    y = identity_function(a3)

    return y


