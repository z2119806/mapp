import numpy as np

"""
损失函数
y输出
t训练数据
"""
def mean_squared_error(y, t):
    return 0.5 * np.sum((y - t) ** 2)

def cross_entropy_error(y, t):
    if y.ndim == 1:
        t = t.reshape(1, t.size)
        y = y.reshape(1, y.size)

    # 监督数据是one-hot-vector的情况下，转换为正确解标签的索引
    if t.size == y.size:
        t = t.argmax(axis=1)

    batch_size = y.shape[0]
    return -np.sum(np.log(y[np.arange(batch_size), t] + 1e-7)) / batch_size

# 设2为正解
t = [0,0,1,0,0,0,0,0,0,0]
# 2的概率0.6
y = [0.1,0.05,0.6,0.0,0.05,0.1,0.0,0.1,0.0,0.0]
r = cross_entropy_error(np.array(y), np.array(t))
# print(r)
# 7 - 0.6
y = [0.1,0.05,0.1,0.0,0.05,0.1,0.0,0.6,0.0,0.0]
r = cross_entropy_error(np.array(y), np.array(t))
# print(r)

