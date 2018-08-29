<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class MdEditor extends Field
{
    public static $js = [
        '/editor.md/editormd.min.js',
    ];

    public static $css = [
        '/editor.md/css/editormd.min.css'
    ];

    protected $view = 'admin.mdeditor';

    public function render()
    {
//        $this->script = "$('textarea.editormd').editormd();";
        $this->script = <<<SCRIPT
            $(function() {
                mdEditor = editormd("editormd1", {
                    width   : "100%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "/lib/"
                });
            });

SCRIPT;


        return parent::render();
    }
}