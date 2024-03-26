@extends('layouts.app')
@section('title', 'Nouveau Document')
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
        <h3>@lang('Publish') @lang('New') Document</h3>
        <p class="text-muted">@lang('lang.text_file_add')</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form method="POST" enctype="multipart/form-data" type style="width:50vw; min-width:300px;">
            @csrf

             <!-- English -->
             <div class="border border-1px p-3">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="titre_en">@lang('Title') @lang('English'):</label>
                        <input type="text" class="form-control" id="titre_en" name="titre_en" placeholder=""
                            value="{{ old('titre_en')}}">
                    </div>
                </div>
            </div>
                <!-- French -->
            <div class="border border-1px p-3 mt-2">
                <div class="row mb-3 ">
                    <div class="col">
                        <label class="form-label" for="titre_fr">@lang('Title') @lang('French'):</label>
                        <input type="text" class="form-control" id="titre_fr" name="titre_fr" placeholder=""
                            value="{{ old('titre_fr')}}">
                    </div>
                </div>
                <!-- ------ -->
            <div>
            
            <div class="border border-1px p-3 mt-2">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="file">@lang('Upload') document :</label>
                        <input type="file" class="form-control" name="file"  id="file" accept=".pdf,.zip,.doc">
                    </div>
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success"> @lang('Publish')</button>
            </div>
        </form>
    </div>
</div>


@endsection