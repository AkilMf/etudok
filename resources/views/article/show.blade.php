@extends('layouts.app')
@section('title', 'Article')
@section('content')

<!--  errors show-->
<!-- @if(!$errors->isEmpty())
<div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif -->

<div class="container">
   
    <div class="wrapper">
        <div class="card">
            <div class="card-banner">
                <p class="category-tag technology">Etudok</p>
            </div>
            <div class="card-body">
                <h4 class="blog-title">{{$articleF['titre']}}</h2>
                <p class="blog-description">{{$articleF['contenu']}}</p>
                <div class="card-profile">
                    <div class="card-profile-info">
                        <h3 class="profile-name">{{$articleF['date']}}</h3>
                        <p class="date-cr">by {{$articleF['etudiant']}}</p>
                    </div>
                </div>
                @if($articleF['etudiant_id'] == auth()->id())
                <a href="#suppression" class="btn btn-danger me-2" data-toggle="modal">@lang('Delete')</a>
                <a href="{{route('article.edit', $articleF['id'])}}" class="btn btn-primary">@lang('Edit')</a>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->
<div id="suppression" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title">@lang('Confirm')?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('lang.text_confirmation_delete') ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">@lang('Cancel')</button>


                <form action="{{ route('article.delete', $articleF['id'])}}" method="POST" class="deleteForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection