class View(object):
    # 首页
    def welcome(self):
        self.getStyle([
            ["*", 51],
            ["*", 1, " ", 49, "*", 1],
            ["*", 1, " ", 49, "*", 1],
            ["*", 1, " ", 16, "小雪符自动提款机系统", 1, " ", 16, "*", 1],
            ["*", 1, " ", 49, "*", 1],
            ["*", 1, " ", 49, "*", 1],
            ["*", 51],
        ])

    # 生成格式
    def getStyle(self, style):
        for i in style:
            str = ""
            n = 0
            for j in i:
                if n >= len(i):
                    break
                str += i[n] * i[n + 1]
                n += 2
            print(str)





    """
    # 操作界面
    # 1 开户 2 查询 3 取款 4 存款 5 转账 6 改密 7 锁定 8 解锁 9 补卡 0 销户 t 退出
    """
    def option(self):
        pass;