import urllib.request, json
from tkinter import *

def add(mobile, num, radio, pwd):
    base_url = ['', 'http://napi.bb.cc', 'http://pservice.banbanapp.com', 'http://api.banbanapp.com']

    t = 10
    muo = num % t

    if muo == 0:
        end = num / t
    else:
        end = num / t + 1

    end = int(end)
    mstr = ''
    for i in range(0, end):
        if i == end - 1 and muo != 0:
            t = num - t * i
        url = base_url[int(radio)] + '/c/test?token=cy20190529&&mobile=' + str(mobile) + '&num=' + str(t) + '&pwd=' + str(pwd)
        #print(url)
        response = urllib.request.urlopen(url)
        read = response.read()
        read = json.loads(read)
        if read['code'] != 200:
            exit()
        else:
            mobile = read['message']
            #print(mobile)
            if end == 1:
                jindu = 100
            else:
                jindu = format(i / (end - 1), '.2f')
                jindu = int(float(jindu) * 100)
            mstr += '当前进度' + str(jindu) + '%,添加手机号：' + str(int(mobile) - 1) + '\r'
            msg.config(text=mstr, bg='white')
            msg.update()

def query():
    mobile = e1.get()
    num = e2.get()
    radio = e3.get()
    pwd = e4.get()
    if mobile.isdigit() == False or num.isdigit() == False:
        exit()
    add(int(mobile), int(num), radio, pwd)

tk = Tk()
tk.title('用户注册机')
tk.geometry('500x600')

e1, e2, e3, e4 = StringVar(), StringVar(), StringVar(), StringVar()
e3.set(2)
l = Label(tk, text='输入开始手机号（包括本身）：')
l.grid(row=1, column=1, padx=1, pady=20)
Entry(tk, show=None, font=('Arial', 14), validate='key', textvariable=e1).grid(row=1, column=2, padx=1, pady=1)

Label(tk, text='数量：').grid(row=3, column=1, padx=1, pady=4)
Entry(tk, show=None, font=('Arial', 14), validate='key', textvariable=e2).grid(row=3, column=2, padx=1, pady=4)

Label(tk, text='操作密码：').grid(row=4, column=1, padx=1, pady=4)
Entry(tk, show='*', font=('Arial', 14), validate='key', textvariable=e4).grid(row=4, column=2, padx=1, pady=4)

Radiobutton(tk, text='本地', variable=e3, value='1').grid(row=5, column=0, columnspan=3)
Radiobutton(tk, text='测试', variable=e3, value='2').grid(row=5, column=1)
Radiobutton(tk, text='正式', variable=e3, value='3').grid(row=5, column=2)

Label(tk, text='消息(每次添加20个)：').grid(row=6, column=1, padx=1, pady=5)
msg = Message(tk, width=400)
msg.grid(row=7, column=1, columnspan=5, pady=1, padx=1)
Button(tk, text='开始', command=query).grid(row=8, column=1, padx=1, pady=10)
Label(tk, text='！！！注：操作有误或不符合验证直接退出软件，请重新运行！\r另，页面卡住了不用关闭，等待进度100%').grid(row=9, column=1, columnspan=3, padx=1, pady=5)
mainloop()