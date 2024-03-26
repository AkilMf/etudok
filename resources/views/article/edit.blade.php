@extends('layouts.app')
@section('title', 'Modification Article')
@section('content')

<!--  errors show-->
@if(!$errors->isEmpty())
<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
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
        <h3>@lang('Modify') Article</h3>
        <p class="text-muted"></p>
    </div>

    <div class="container d-flex justify-content-center">
        <form method="POST" style="width:50vw; min-width:300px;">
            @csrf
            @method('put')
             <!-- English -->
             <div class="border border-1px p-3">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="titre_en">@lang('Title') @lang('English'):</label>
                        <input type="text" class="form-control" id="titre_en" name="titre_en" placeholder=""
                            value="{{ old('titre_en', $article->titre['en'])}}">
                    </div>
                </div>

            
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="contenu_en">@lang('Content') @lang('English') :</label>
                        <textarea type="text" rows="8" cols="10" class="form-control" name="contenu_en" id="contenu_en" placeholder=""  
                        value="{{ old('contenu_en', $article->contenu['en'])}}">{{ old('contenu_en', $article->contenu['en'])}}</textarea>
                    </div>
                </div>
            </div>
                <!-- French -->
            <div class="border border-1px p-3 mt-2">
                <div class="row mb-3 ">
                    <div class="col">
                        <label class="form-label" for="titre_fr">@lang('Title') @lang('English'):</label>
                        <input type="text" class="form-control" id="titre_fr" name="titre_fr" placeholder=""
                            value="{{(array_key_exists('fr', $article->titre)) ? old('titre_fr', $article->titre['fr']) : '' }}" />
                    </div>
                </div>
            

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="contenu_fr">@lang('Title') @lang('French') :</label>
                        <textarea type="text" rows="8" cols="10" class="form-control" name="contenu_fr" id="contenu_fr" placeholder="" 
                         value="{{(array_key_exists('fr', $article->contenu)) ? old('titre_fr', $article->contenu['fr']) : '' }}">{{(array_key_exists('fr', $article->contenu)) ? old('titre_fr', $article->contenu['fr']) : '' }}</textarea>
                         
                    </div>
                </div> 

            <div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">@lang('Edit')</button>
                <a href="{{route('article.index')}}" class="btn btn-danger">@lang('Cancel')</a>
            </div>
        </form>
    </div>
</div>


@endsection