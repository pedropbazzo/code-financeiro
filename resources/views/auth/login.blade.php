@extends('layouts.admin')

@section('content')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="box-login">
                <div class="col s8 offset-s2 z-depth-2">
                    <h4 class="center"> Sistema Financeiro - Admin</h4>
                    <form role="form" method="POST" action="{{ env('URL_ADMIN_LOGIN') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field col s12">
                                <?php $messageError =  $errors->has('email') ? "data-error='{$errors->first('email')}'" : null ?>
                                <input id="email" type="email" class="validate {{$messageError? 'invalid' : $messageError }}" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email"{!! $messageError !!}>E-Mail</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <?php $messageError =  $errors->has('password') ? "data-error='{$errors->first('password')}'" : null ?>
                                <input id="password" type="password" class="validate {{$messageError? 'invalid' : $messageError }}" name="password" value="{{ old('password') }}" required autofocus>
                                <label for="password"{!! $messageError !!}>Senha</label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field col s12">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Lembrar-me</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn">
                                    Login
                                </button>
                                <a class="btn" href="{{ url('/password/reset') }}">
                                    Esqueçeu sua senha?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
