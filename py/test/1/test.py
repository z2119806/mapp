# coding: utf-8
import sys, os
sys.path.append(os.pardir)  # 为了导入父目录的文件而进行的设定
import numpy as np
import matplotlib.pyplot as plt
from common.functions import *
from dataset.mnist import load_mnist
from two_layer_net import TwoLayerNet

# 展示图片
def tu(x, y, x1 = -0.1, y1 = 1.1, xn = 'x', yn = 'y'):
    plt.plot(x, y)
    plt.ylim(x1, y1)
    plt.xlabel(xn)
    plt.ylabel(yn)
    plt.show()

# 阶跃函数
# x = np.arange(-5.0, 5.0, 0.1) # x=-5.0 -> x - 0.1 -> 5.0
# y = step_function(x)
# tu(x, y)

# sigmoid函数
x = np.arange(-5.0, 5.0, 0.1)
y = sigmoid(x)
# tu(x, y)