@extends('layouts.app')
@section('title', 'Document')
@section('content')

<div class="container mt-5">
    <div class="row">

        <div class="col-md-20">
            <!-- student Information -->
            <div class="card file-info-card">
                <div class="card-body">
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h3>{{$fichierF['titre']}}</h3></li>
                        <div class="col-md-3 text-left ls-d">
                            
                            <li class="list-group-item"><strong>Date:</strong> {{$fichierF['date']}}</li>
                            <li class="list-group-item"><strong>@lang('Author'):</strong> {{$fichierF['etudiant']}}</li>
                        </div>
                        
                        @if($fichierF['extension'] == 'pdf')
                            <embed src="{{ asset('fichiers/' . $fichierF['file']) }}" type="application/pdf" width="100%" height="600px">
                        @else
                            <a href="{{ asset('fichiers/' . $fichierF['file']) }}" download> @lang('Download') Document</a>
                        @endif
                        

                        

                    </ul>
                </div>
                @if($fichierF['etudiant_id'] == Auth::user()->id)
                    <a href="#suppression" class="btn  btn-outline-danger mt-2" data-toggle="modal">@lang('Delete')</a>
                    <a href="{{route('fichier.edit', $fichierF['id'])}}" class="btn  btn-outline-success mt-2">@lang('Edit')</a>
                @endif
             </div>
            
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
                <h4 class="modal-title">@lang('Confirm') ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('lang.text_confirmation_delete') ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">@lang('Cancel')</button>


                <form action="{{ route('fichier.delete', $fichierF['id'])}}" method="POST" class="deleteForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection