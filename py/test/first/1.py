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

A = np.array([[1, 2], [3, 4]])
B = np.array([[5, 6], [7, 8]])
print(np.dot(A, B))