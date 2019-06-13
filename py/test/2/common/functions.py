import numpy as np

"""
激活函数-sigmoid函数
主要用于求曲线 
-1/大于1取值范围1-0之间 
?-x为倒序 x升序
为什么用0和1，概率问题0%-100%
形参值越大，返回越大，反之..
"""
def sigmoid(x):
    return 1 / (1 + np.exp(-x))

# 输出函数
# 恒等函数
def identity_function(x):
    return x

"""
softmax函数
输出函数
作用：不会对输入元素的大小位置所改变，将各个值转换成总和为1的小数，以便求概率。
也就是每个输入元素 / 所有元素的总和，引入e是避免循环
"""
def softmax(x):
    if x.ndim == 2:
        x = x.T
        x = x - np.max(x, axis=0)
        y = np.exp(x) / np.sum(np.exp(x), axis=0)
        return y.T

    x = x - np.max(x) # 溢出对策
    return np.exp(x) / np.sum(np.exp(x))

"""
交叉熵误差
"""


def cross_entropy_error(y, t):
    if y.ndim == 1:
        t = t.reshape(1, t.size)
        y = y.reshape(1, y.size)

    # 监督数据是one-hot-vector的情况下，转换为正确解标签的索引
    if t.size == y.size:
        t = t.argmax(axis=1)

    batch_size = y.shape[0]
    return -np.sum(np.log(y[np.arange(batch_size), t] + 1e-7)) / batch_size