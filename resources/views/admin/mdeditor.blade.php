<?php
/**
 * @author will <wizarot@gmail.com>
 * @link http://wizarot.me/
 *
 * Date: 2018/8/29
 * Time: 下午1:57
 */
?>

<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea id="editormd1" class="form-control editormd {{ $class }}" name="{{$name}}"  placeholder="{{ $placeholder }}" {!! $attributes !!} >{{ old($column, $value) }}</textarea>

        @include('admin::form.help-block')

    </div>
</div>