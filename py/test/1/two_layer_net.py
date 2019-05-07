import sys, os
sys.path.append(os.pardir) # 引入父级
from common.functions import *
#from common.gradient import numerical_gradient

a = np.array([-2,-1,0,1,2])
print(sigmoid(a))