<?php
namespace app\api\validate;

use \app\api\library\base\BaseValidate,
	\app\api\library\constant\ReturnMessage as rm;

class User extends BaseValidate
{
	protected $rule = [
		'email' => 'require|email',
		'password' => 'require|length:6,16'
    ];

    protected $message = [
        'email.email' => rm::EMAIL_ERROR,
        'email.require' => rm::EMAIL_NOT_EXIST,
        'password.length' => rm::PASSWORD_LENGTH,
        'password.require' => rm::PASSWORD_NOT_EXIST,
    ];

    protected $scene = [
    	'exist' => ['email']
    ];
}