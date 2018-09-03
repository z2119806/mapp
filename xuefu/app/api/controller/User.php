<?php
namespace app\api\controller;

use \app\api\library\base\BaseController,
	\app\api\model\User as U;

class User extends BaseController
{   
    /**
     * 根据邮箱用户是否存在
     */
    public function isUser()
    {   
        $validate = \think\Loader::validate("User");
        if(! $validate->check(input()))
        {
            $this->error();
            echo $validate->getError();die;
        }

        $this->yes([['a'=>123],['b'=>3,'c'=>'as'],1231]);
    }

    /**
     * 登陆或者注册
     * 
     */
    public function login()
    {
        $user = new U;
     
        $user->add();
    }
}