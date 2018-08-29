<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    public static $js = [
        '/ckeditor/ckeditor.js',
        '/ckeditor/adapters/jquery.js',
    ];

    protected $view = 'admin.ckeditor';

    public function render()
    {
//        $this->script = "$('textarea.{$this->getElementClassString()}').ckeditor();";
        // 用这个解决新增ckeditor不生效的问题.
        $this->script = "$('textarea.ckeditor').ckeditor();";

        return parent::render();
    }
}