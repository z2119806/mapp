import numpy as np

# 激活函数
def sigmoid(x):
    return 1 / (1 + np.exp(-x))

# 输出函数
# 恒等函数
def identity_function(x):
    return x

# softmax函数
def softmax(x):
    c = np.max(x)
    exp_a = np.exp(x - c) # 防止溢出，减去相同数，结果不变
    sum_exp_a = np.sum(exp_a)
    y = exp_a / sum_exp_a

    return y
# def softmax(x):
#     if x.ndim == 2:
#         x = x.T
#         x = x - np.max(x, axis=0)
#         y = np.exp(x) / np.sum(np.exp(x), axis=0)
#         return y.T
#
#     x = x - np.max(x)  # 溢出对策
#     return np.exp(x) / np.sum(np.exp(x))