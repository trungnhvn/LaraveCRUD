<div class="form-group{{ $errors->has('post_cate') ? 'has-error' : ''}}">
    {!! Form::label('post_cate', 'Post Category', ['class' => 'control-label']) !!}
    {{ Form::select('post_cate', $cates, null, ['class' => 'form-control col-md-6']) }}
    {!! $errors->first('post_cate', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
    {!! Form::label('post_title', 'Post Title', ['class' => 'control-label']) !!}
    {!! Form::text('post_title', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_tease') ? 'has-error' : ''}}">
    {!! Form::label('post_tease', 'Post Tease', ['class' => 'control-label']) !!}
    {!! Form::textarea('post_tease', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_tease', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">
    {!! Form::label('post_image', 'Post Image', ['class' => 'control-label']) !!}
    {!! Form::file('post_image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
    {!! Form::label('post_content', 'Post Content', ['class' => 'control-label']) !!}
    {!! Form::text('post_content', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
