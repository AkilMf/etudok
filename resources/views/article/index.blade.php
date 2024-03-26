@extends('layouts.app')
@section('title', 'Forum')
@section('content')


<div class="container">
    @forelse($articles as $article)
  <div class="wrapper">
    <div class="card card-article">
        <div class="card-banner">
            <p class="category-tag technology">Etudok</p>
        </div>
        <div class="card-body">
             <h4 class="blog-title">{{$article['titre']}}</h2>
             <p class="blog-description">{{$article['contenu']}}</p>
            <div class="card-profile">
                <div class="card-profile-info">
                    <h3 class="profile-name">{{$article['date']}}</h3>
                    <p class="date-cr">@lang('by') {{$article['etudiant']}}</p>
                </div>
            </div>

        </div>
        <a href="{{route('article.show', $article['id'])}}"><button type="button" class="btn btn-primary" >
                    @lang('Read More')
                </button></a>
    </div>
    @empty
    <div class="alert alert-danger">@lang('lang.text_no_articles')</div>
    @endforelse
</div>



@endsection