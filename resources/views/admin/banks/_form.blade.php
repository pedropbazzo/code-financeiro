@include('errors._error_field')

<div class="row">
    <div class="imput-field col s6">
        {!! Form::label('name', 'Nome') !!}
        {!! Form::text('name', null) !!}
    </div>
</div>



{{--<?php $errorClass = $errors->first('name') ? ['class' => 'validate invalid']: [] ?>--}}
{{--<div class="row">--}}
{{--    <div class="imput-field col s6">--}}
{{--        {!! Form::text('name', null, $errorClass) !!}--}}
{{--        {!! Form::label('name', 'Nome', ['data-error' => $errors->first('name')]) !!}--}}
{{--    </div>--}}
{{--</div>--}}