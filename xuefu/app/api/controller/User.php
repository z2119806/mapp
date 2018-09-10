<?php
namespace app\api\controller;

use \think\Loader,
    \app\library\base\BaseController,
    \app\library\constant\ReturnMessage,
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

        $this->yesno($data, ReturnMessage::USER_NOT_EXIST);
    }

    /**
     * 登陆或者注册
     *
     * 当不存在的时候注册，否则登陆
     */
    public function login()
    {
        $data = input();
        $validate = Loader::validate("User");
        if(! $validate->check($data)) $this->no($validate->getError());

        $user = U::one($data['email']);
        if (! $user)
        {
            $user = new U;
            $user = $user->add($data);
        }

        $user ? $this->yes($user) : $this->no();
    }
}