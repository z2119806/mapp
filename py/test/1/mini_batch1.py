# coding: utf-8
import sys, os
sys.path.append(os.pardir)  # 为了导入父目录的文件而进行的设定
import numpy as np
import matplotlib.pyplot as plt
from dataset.mnist import load_mnist
from two_layer_net import TwoLayerNet

# x_train训练数据，t_train监督数据，x_test测试数据，t_test测试监督数据
(x_train, t_train), (x_test, t_test) = load_mnist(normalize = True, one_hot_label = True)

# 超参数
iters_num = 1000 # 循环次数
train_size = x_train.shape[0] # 60000 训练数据大小
batch_size = 100 # 批次大小，每次取100个随机数
learning_rate = 0.1 # 学习率

train_loss_list = []
train_acc_list = []
test_acc_list = []

# 平均每个epoch重复次数
iter_per_epoch = max(train_size / batch_size, 1)

# 参数：输入层神经元数、隐藏层神经元数、输出层神经元数
network = TwoLayerNet(input_size = 784, hidden_size = 50, output_size = 10)

for i in range(iters_num):
    # 获取mini-batch 60000 100
    batch_mask = np.random.choice(train_size, batch_size)

    # 去若干个（随机）训练数据
    x_batch = x_train[batch_mask]
    # 去若干个对应上面（随机）监督数据
    t_batch = t_train[batch_mask]

    # 计算梯度
    grad = network.gradient(x_batch, t_batch)

    # 更新参数
    for key in ('W1', 'b1', 'W2', 'b2'):
        network.params[key] -= learning_rate * grad[key]

    # 记录学习过程
    loss = network.loss(x_batch, t_batch)
    train_loss_list.append(loss)

    if i % iter_per_epoch == 0:
        train_acc = network.accuracy(x_train, t_train)
        test_acc = network.accuracy(x_test, t_test)
        train_acc_list.append(train_acc)
        test_acc_list.append(test_acc)
        print("train acc, test acc | " + str(train_acc) + ", " + str(test_acc))

# 绘制图形
markers = {'train': 'o', 'test': 's'}
x = np.arange(len(train_acc_list))
plt.plot(x, train_acc_list, label='train acc')
plt.plot(x, test_acc_list, label='test acc', linestyle='--')
plt.xlabel("epochs")
plt.ylabel("accuracy")
plt.ylim(0, 1.0)
plt.legend(loc='lower right')
plt.show()