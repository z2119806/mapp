

import turtle
"""
基本命令
# 移动 forward(int 长度)
# 右 right(int 角度)
# 左 left(int 角度)
# 坐标 goto(int x, y)
# 速度 speed(int 0-10)
"""

"""
控制命令
# 隐藏箭头 hideturtle()
# 显示箭头 showturtle()
# 抬起画笔 up()
# 放下画笔 down()
# 改变箭头朝向 setheading(int 角度)
# 大小 pensize(int)
# 颜色 pencolor(str)

# 画圆 circle(50, steps = 1 点 2 线段 3 三角 4 四边 .... 默认圆)

# 撤回上一步 undo()
# 清除并且关闭窗口 clean()
# 同上不关闭窗口 reset()
"""

"""
其他命令
# 完成画布不消失 done()
"""

# 九宫格
t = turtle

t.hideturtle()
t.speed(7)

n = 8
i = 1
x1 = -300
y1 = 200
x2 = -260
y2 = 240

while i <= n:
    t.up()
    t.goto(x1, y1)
    t.down()
    t.forward(360)
    t.right(90)
    t.up()
    t.goto(x2, y2)
    t.down()
    t.forward(400)
    t.left(90)
    i += 1
    y1 -= 40
    x2 += 40

turtle.done()
