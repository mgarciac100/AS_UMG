@extends('layouts/blankLayout')

@section('title', 'Login Básico - Páginas')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">

        <!-- Login -->
        <div class="card p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-5">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
              <span class="app-brand-text demo text-heading fw-semibold">{{config('variables.templateName')}}</span>
            </a>
          </div>
          <!-- /Logo -->

          <div class="card-body mt-2">
            <h4 class="mb-2">¡Bienvenido a {{config('variables.templateName')}}! 👋</h4>
            <p class="mb-4">Por favor inicia sesión en tu cuenta y comienza la aventura</p>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa tu correo o usuario" autofocus>
                <label for="email">Correo o Usuario</label>
              </div>
              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                      <label for="password">Contraseña</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>
              <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Recuérdame
                  </label>
                </div>
                <a href="{{url('auth/forgot-password-basic')}}" class="float-end mb-1">
                  <span>¿Olvidaste tu contraseña?</span>
                </a>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Iniciar sesión</button>
              </div>
            </form>

            <p class="text-center">
              <span>¿Eres nuevo en nuestra plataforma?</span>
              <a href="{{url('auth/register-basic')}}">
                <span>Crear una cuenta</span>
              </a>
            </p>
          </div>
        </div>
        <!-- /Login -->
        <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
        <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
        <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
      </div>
    </div>
  </div>
@endsection
