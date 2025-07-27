@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h4 class="mb-4 text-center">Iniciar Sesión</h4>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="form-group">
          <label for="name">Usuario</label>
          <input type="text" name="name" class="form-control" required autofocus>
        </div>

        <div class="form-group mt-3">
          <label for="password">Contraseña</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group mt-4 text-center">
          <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection