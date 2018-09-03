<?php
namespace app\api\validate;

use \app\api\library\base\BaseValidate,
	\app\api\library\constant\ReturnMessage;

class User extends BaseValidate
{
	protected $rule = [
        'email' => 'email',
    ];

    protected $message = [
        'email' => ReturnMessage::EMAIL_ERROR,
    ];
}