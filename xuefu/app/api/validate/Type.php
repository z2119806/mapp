<?php
namespace app\api\validate;

use \app\library\base\BaseValidate,
	\app\library\constant\ReturnMessage as rm;

class Type extends BaseValidate
{
	protected $rule = [
		'title' => 'require'
    ];

    protected $message = [
        'title.require' => rm::TYPE_TITLE_NULL
    ];
}