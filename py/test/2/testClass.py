from common.functions import *

class test:
    def __init__(self):
        self.params = {}
        self.params['W1'] = np.array([[0.1, 0.3, 0.5], [0.2, 0.4, 0.6]])
        self.params['b1'] = np.array([0.1, 0.2, 0.3])
        self.params['W2'] = np.array([[0.1, 0.4], [0.2, 0.5], [0.3, 0.6]])
        self.params['b2'] = np.array([0.1, 0.2])
        self.params['W3'] = np.array([[0.1, 0.3], [0.2, 0.4]])
        self.params['b3'] = np.array([0.1, 0.2])

    def forward(self, x):
        W1, W2, W3 = self.params['W1'], self.params['W2'], self.params['W3'],
        b1, b2, b3 = self.params['b1'], self.params['b2'], self.params['b3'],
        a1 = np.dot(x, W1) + b1
        z1 = sigmoid(a1)
        a2 = np.dot(z1, W2) + b2
        z2 = sigmoid(a2)
        a3 = np.dot(z2, W3) + b3
        y = softmax(a3)

        return y

# a = test()
# x1 = np.array([1.0, 0.5])
# r1 = a.forward(x1)
# print(r1)

a = np.array([10,11,12])
print(np.sum(a))
b = a / np.sum(a)
x = np.exp(a) / np.sum(np.exp(a))
c = np.max(a)
d = a - c
e = np.exp(d) / np.sum(np.exp(d))
print(e)

