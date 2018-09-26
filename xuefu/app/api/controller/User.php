<?php
namespace app\api\controller;

use \think\Loader,
    \app\library\base\BaseController,
    \app\library\constant\ReturnMessage,
	\app\api\model\User as U;

class User extends BaseController
{   
    public $notLogin = ['login', 'exist'];

    /**
     * 根据邮箱用户是否存在
     *
     * @param $[email] [<邮箱>]
     * @return [json]
     * @author [🍀] [2018.09.04]
     */
    public function exist()
    {   
        // 获取值
        $data = input();

        // 验证
        $validate = Loader::validate("User");
        if(! $validate->scene('exist')->check($data)) $this->no($validate->getError());

        // 返回
        $this->yesno($this->setReturnData(user($data['email'])), ReturnMessage::USER_NOT_EXIST);
    }

    /**
     * 登陆或者注册
     *
     * 当不存在的时候注册，否则登陆
     */
    public function login()
    {
        // 获取值
        $data = input();

        // 验证
        $validate = Loader::validate("User");
        if(! $validate->check($data)) $this->no($validate->getError());

        // 判断注没注册过
        $user = user($data['email']);

        $u = new U;
        if ($user)
        {
            if (! $u->saveToken($user)) $this->no();

        }else
            $user = $u->add($data);

        // 返回
        $this->yesno($this->setReturnData($user));
    }
}