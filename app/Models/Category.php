<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'categories';

    public function questions()
    {
        return $this->hasMany(Questions::class,'category_id');
    }

    /**
     * Get options for Select field in form.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function selectOptions()
    {
        $options = (new static())->buildSelectOptions([],0,'━');

        return collect($options)->prepend('Root', 0)->all();
    }
}
