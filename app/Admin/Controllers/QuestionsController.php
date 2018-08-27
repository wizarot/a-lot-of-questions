<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Questions;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class QuestionsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('题目');
            $content->description('题目管理');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('详情');
            $content->description('');

            $content->body(Admin::show(Questions::findOrFail($id), function (Show $show) {

                $show->id();
                $show->content("题干部分");
                $show->tips("提示信息");
                $show->answer("答案")->as(function($answers) {
                    $result = '';
                    foreach (json_decode($answers, true) as $item) {
                        $result .= "<li>{$item['content']}</li>";
                    }
                    return "<ul>$result</ul>";
                });
                $show->distractor("干扰项")->as(function($distractors) {
                    $result = '';
                    foreach (json_decode($distractors, true) as $item) {
                        $result .= "<li>{$item['content']}</li>";
                    }

                    return "<ul>$result</ul>";
                });
                $show->created_at();
                $show->updated_at();
            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Questions::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('category.title','题目分类');
            $grid->column('content','内容')->display(function($text) {
                return $text;
                $text = strip_tags($text);
                return str_limit($text, 50, '...');
            });

            $grid->created_at('建立时间');
            $grid->updated_at('修改时间');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Questions::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->select('category_id', '题目类型')->options(Category::selectOptions());
            $form->ckeditor('content', '题目内容');
            $form->ckeditor('tips', '解题思路');
            $form->hasMany('answer', '正确答案', function (Form\NestedForm $form) {
                $form->ckeditor('content','答案');//->rules('required');
            });
            $form->hasMany('distractor', '干扰项', function (Form\NestedForm $form) {
                $form->ckeditor('content','干扰项');//->rules('required');
            });


            $form->display('created_at', '建立时间');
            $form->display('updated_at', '修改时间');
        });
    }
}
