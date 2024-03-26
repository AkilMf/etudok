@extends('layouts.app')
@section('title', trans('Login'))
@section('content')

<!--  errors show-->
@if(!$errors->isEmpty())
<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif


<div class="container">
    <div class="text-center mb-4">
        <h3>@lang('Login')</h3>
        <p class="text-muted">@lang('lang.text_login')</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form method="POST" style="width:50vw; min-width:300px;">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="email">@lang('Email') :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('lang.text_placeH_mail')"  value="{{ old('email')}}">
                    @if($errors->has('email'))
                    <div class=" text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>

            </div>

            
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="password">@lang('Password') :</label>
                    <input type="password" class="form-control" id="password" minlength="6" maxlength="20" name="password" placeholder="@lang('lang.text-placeholder_psw')" required>
                    @if($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
            </div>



            <div class="mt-3">
                <button type="submit" class="btn btn-success">@lang('Login')</button>
            </div>
        </form>
    </div>
</div>

@endsection