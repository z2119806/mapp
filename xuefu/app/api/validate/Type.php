<?php
namespace app\api\validate;

use \app\library\base\BaseValidate,
	\app\library\constant\ReturnMessage as rm;

class Type extends BaseValidate
{
	protected $rule = [
		'title' => 'require|max:30',
		'box_id' => 'require',
    ];

    protected $message = [
        'title.require' => rm::TYPE_TITLE_NULL,
        'box_id.require' => rm::TYPE_PID_NULL,
        'title.max' => rm::TYPE_TITLE_LENGTH,
    ];

    protected $scene = [
    	'storage' => ['box_id'],
        'bookself' => ['title'],
    	'storage_add' => ['box_id', 'title'],
    ];
}