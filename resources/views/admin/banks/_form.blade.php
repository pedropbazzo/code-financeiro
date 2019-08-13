@include('errors._error_field')

<div class="row">
    <div class="imput-field col s6">
        {!! Form::label('name', 'Nome') !!}
        {!! Form::text('name', null) !!}
    </div>
</div>

<div class="row">
    <div class="input-field file-field col s6">
        <div class="btn">
            <span>Upload Logo</span>
            {!! Form::file('logo') !!}
        </div>
        <div class="file-path-wrapper">
            <input type="text" class="file-path"/>
        </div>
    </div>
</div>


{{--<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid']: [] ?>--}}
{{--<div class="row">--}}
{{--    <div class="imput-field col s6">--}}
{{--        {!! Form::text('name', null, $errorClass) !!}--}}
{{--        {!! Form::label('name', 'Nome', ['data-error' => $errors->first('name')]) !!}--}}
{{--    </div>--}}
{{--</div>--}}