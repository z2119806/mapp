import matplotlib.pyplot as plt
import numpy as np

x = np.linspace(-10, 10, 30)
print(x)
y = x ** 2 + 3 * x - 2

# 设置 x y
plt.plot(x, y)
# 原点
plt.plot(0, 0, marker='o')
# 线
plt.plot((0, 3), (0, 20), linestyle='--')
plt.show()