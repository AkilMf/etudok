@extends('layouts.app')
@section('title','Liste etudiant')
@section('content')

<!-- Jumbotron -->
<div class="jumbotron">
    <h1 class="display-4">Bienvenue sur ETUDOK ! </h1>
    <p class="lead">Restez en contact avec d'autres étudiants sur notre futur réseau social !</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Take the Survey</a>
    <hr class="my-4">
    <p>Aidez nous afin d'améliorer nos services.</p>
    <a class="btn btn-light btn-lg" href="{{route('etudiant.index')}}" role="button">Rejoignez-nous !</a>
</div>


@endsection('content')