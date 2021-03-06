<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Admin\Extensions\Form\CKEditor;
use App\Admin\Extensions\Form\MdEditor;
use Encore\Admin\Form;

Form::forget(['map', 'editor']);


Form::extend('ckeditor', CKEditor::class);
//Form::extend('mdedtior', MdEditor::class);


Admin::js(['//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS-MML_HTMLorMML','//apps.bdimg.com/libs/highlight.js/9.1.0/highlight.min.js']);

Admin::css('/ckeditor/plugins/codesnippet/lib/highlight/styles/solarized_dark.css');


$script = <<<SCRIPT
hljs.initHighlightingOnLoad();

$(document).ready(function() {
  $('pre').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});

SCRIPT;

Admin::script($script);