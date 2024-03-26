@extends('layouts.app')
@section('title', trans('Welcome'))
@section('content')

<!-- Jumbotron -->
<div class="jumbotron">
    <h1 class="display-4">@lang('lang.text_welcome') ETUDOK ! </h1>
    <p class="lead">@lang('lang.text_welcome_paragraph')</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">@lang('lang.text_survey_btn')</a>
    <hr class="my-4">
    <p>@lang('lang.text_marketing')</p>
    <a class="btn btn-light btn-lg" href="{{route('etudiant.index')}}" role="button">@lang('lang.text_joinUs')</a>
</div>


@endsection('content')