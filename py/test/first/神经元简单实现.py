import numpy as np
import matplotlib.pylab as plt

# numpy的阶跃函数
def step_function(x):
    return np.array(x > 0, dtype = np.int)

# numpy的sigmoid函数（激活函数之一）
def sigmoid(x):
    return 1 / (1 + np.exp(-x))

# x = np.arange(-5.0, 5.0, 0.1)
# y1 = sigmoid(x)
# y2 = step_function(x)
#
# plt.plot(x, y1, label = 'sigmoid')
# plt.plot(x, y2, label = 'step_function', linestyle = '--')
# plt.ylim(-0.1, 1.1)
# plt.xlabel("x")
# plt.ylabel("y")
# plt.title("sigmoid && step")
# plt.legend()
# plt.show()

# 输入层到第一层神经元
X = np.array([1.0, 0.5])
W1 = np.array([[0.1, 0.3, 0.5], [0.2, 0.4, 0.6]])
B1 = np.array([0.1, 0.2, 0.3])
A1 = np.dot(X, W1) + B1
Z1 = sigmoid(A1) # 激活函数激活

# 第一层到第二层
W2 = np.array([[0.1, 0.4], [0.2, 0.5], [0.3, 0.6]])
B2 = np.array([0.1, 0.2])

A2 = np.dot(Z1, W2) + B2
Z2 = sigmoid(A2)

# 第二层到输出层
W3 = np.array([[0.1, 0.3], [0.2, 0.4]])
B3 = np.array([0.1, 0.2])

A3 = np.dot(Z2, W3) + B3
print(A3)

