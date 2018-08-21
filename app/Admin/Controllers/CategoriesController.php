<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Encore\Admin\Tree;
use Encore\Admin\Widgets\Box;

class CategoriesController extends Controller
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

//            $content->header('Index');
//            $content->description('description');
//            $content->body($this->grid());

            $content->header('题目分类');
            $content->description('列表');

//            $content->body(Category::tree());
            $content->row(function (Row $row) {
                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new \Encore\Admin\Widgets\Form();
                    $form->action(admin_base_path('categories'));

                    $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
                    $form->text('title', trans('admin.title'))->rules('required');
                    $form->text('desc', '备注');
                    $form->icon('icon', trans('admin.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());
//                    $form->text('uri', trans('admin.uri'));
//                    $form->multipleSelect('roles', trans('admin.roles'))->options(Role::all()->pluck('name', 'id'));
                    $form->hidden('_token')->default(csrf_token());

                    $column->append((new Box('新增', $form))->style('success'));
                });
            });

        });
    }

    /**
     * Help message for icon field.
     *
     * @return string
     */
    protected function iconHelp()
    {
        return 'For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a>';
    }

    /**
     * @return \Encore\Admin\Tree
     */
    protected function treeView()
    {
        return Category::tree(function (Tree $tree) {
            $tree->disableCreate();

            $tree->branch(function ($branch) {
                $payload = "<i class='fa {$branch['icon']}'></i>&nbsp;<strong>{$branch['title']}</strong>";

//                if (!isset($branch['children'])) {
//                    if (url()->isValidUrl($branch['uri'])) {
//                        $uri = $branch['uri'];
//                    } else {
//                        $uri = admin_base_path($branch['uri']);
//                    }
//
//                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
//                }

                return $payload;
            });
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

            $content->header('Detail');
            $content->description('description');

            $content->body(Admin::show(Category::findOrFail($id), function (Show $show) {

                $show->id();

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

            $content->header('Edit');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

//    /**
//     * Create interface.
//     *
//     * @return Content
//     */
//    public function create()
//    {
//        return Admin::content(function (Content $content) {
//
//            $content->header('Create');
//            $content->description('description');
//
//            $content->body($this->form());
//        });
//    }

//    /**
//     * Make a grid builder.
//     *
//     * @return Grid
//     */
//    protected function grid()
//    {
//        return Admin::grid(Category::class, function (Grid $grid) {
//
//            $grid->id('ID')->sortable();
//
//            $grid->created_at();
//            $grid->updated_at();
//        });
//    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Category::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->select('parent_id', trans('admin.parent_id'))->options(Category::selectOptions());
            $form->text('title', '标题')->rules('required');
            $form->text('desc', '备注');
            $form->icon('icon', trans('admin.icon'))->default('fa-bars')->rules('required')->help($this->iconHelp());

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
