<div class="form-group {{ $errors->has('cate_name') ? 'has-error' : ''}}">
    {!! Form::label('cate_name', 'Cate Name', ['class' => 'control-label']) !!}
    {!! Form::text('cate_name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cate_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cate_desc') ? 'has-error' : ''}}">
    {!! Form::label('cate_desc', 'Cate Desc', ['class' => 'control-label']) !!}
    {!! Form::text('cate_desc', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cate_desc', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('cate_img') ? 'has-error' : ''}}">
    {!! Form::label('cate_img', 'Cate Image', ['class' => 'control-label']) !!}
    {!! Form::file('cate_img', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cate_img', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
