<?php
namespace app\api\controller;

use \think\Loader,
    \app\api\library\base\BaseController,
    \app\api\library\constant\ReturnMessage,
	\app\api\model\User as U;

class User extends BaseController
{   
    /**
     * 根据邮箱用户是否存在
     *
     * @param $[email] [<邮箱>]
     * @return [json]
     * @author [🍀] [2018.09.04]
     */
    public function exist()
    {   
        $data = input();
        $validate = Loader::validate("User");
        if(! $validate->scene('exist')->check($data)) $this->no($validate->getError());

        $data = U::one($data['email']);

        $this->yesno(ReturnMessage::USER_NOT_EXIST);
    }

    /**
     * 登陆或者注册
     * 
     */
    public function login()
    {
        $this->data = input();
        $validate = Loader::validate("User");
        if(! $validate->check($this->data)) $this->no($validate->getError());

        if (U::one($this->data['email']))
        {


        }else
        {
            $user = new U;
            $user->add($this->data);
        }
    }
}