<?php
namespace app\api\validate;

use \app\library\base\BaseValidate,
	\app\library\constant\ReturnMessage as rm;

class Type extends BaseValidate
{
	protected $rule = [
		'title' => 'require',
		'bookshelf_id' => 'require'
    ];

    protected $message = [
        'title.require' => rm::TYPE_TITLE_NULL,
        'bookshelf_id.require' => rm::TYPE_TITLE_NULL,
    ];

    protected $scene = [
    	'storage' => ['bookshelf_id', 'title'],
    	'bookself' => ['title'],
    ];
}