@extends('layouts.app')
@section('title', 'Liste etudiant')
@section('content')



<!-- Person Table -->

<div class="container">
    <a href="{{route('etudiant.create')}}" class="btn btn-dark mb-3">@lang('New Student')</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>

                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Phone')</th>
                <th scope="col">@lang('Email')</th>
                <th scope="col">@lang('City')</th>
                <th scope="col">@lang('Action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($etudiants as $etudiant)
            <tr>
                <!-- <td><a href="{{ route('etudiant.show', $etudiant->id) }}" class="">{{$etudiant->nom}} </a></td> -->
                
                <!-- profitant de belongsTo -->
                <td>{{($etudiant->user) ? $etudiant->user->name : ''}}</td>
                
                <td>{{$etudiant->telephone}}</td>
                <td>{{($etudiant->user) ? $etudiant->user->email : ''}}</td>
                <td>
                    @foreach($villes as $ville)
                    @if($etudiant['ville_id'] == $ville['id'])
                    {{ $ville['nom']}}
                    @endif
                    @endforeach
                </td>
                <td>
                    <!-- Affichage -->
                    <a href="{{route('etudiant.show', $etudiant->id)}}"><i title="@lang('Display') @lang('Student')"
                            class=" link-dark fa fa-eye me-3"></i>
                        <!-- maj -->
                        <a href="{{route('etudiant.edit', $etudiant->id)}}" class="link-dark"><i
                                class="fa-solid fa-pen-to-square fs-5 me-3" title="@lang('Modify') @lang('Student') "></i></a>
                        <!-- delete -->
                        <a href="#suppression" class="link-dark trigger-btn" data-toggle="modal"
                            etudiant-id="{{$etudiant->id}}"><i class="fa-solid fa-trash fs-5"
                                title="@lang('Delete') @lang('Student')"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $etudiants }}
</div>

<!-- Delete Modal HTML -->
<div id="suppression" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>
                <h4 class="modal-title">@lang('Confirm')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>@lang('lang.text_confirmation_delete') ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">@lang('Cancel')</button>


                <form action="{{ route('etudiant.delete', 'etudiantID')}}" method="POST" class="deleteForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">@lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- @inject('EtudiantController', 'App\Http\Controllers\EtudiantController') -->

</div>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        /* Sending etudiant_id to delete modal */
        let triggersBtn = document.querySelectorAll('.trigger-btn');

        let form = document.querySelector('.deleteForm');

        for (let i = 0; i < triggersBtn.length; i++) {
            triggersBtn[i].addEventListener('click', function () {
                let idStudent = triggersBtn[i].getAttribute('etudiant-id'),
                    formAction = form.getAttribute('action'),
                    splitedUrl = formAction.split('/');

                splitedUrl[4] = idStudent;
                let newUrl = splitedUrl.join('/')
                //console.log(newUrl)
                form.setAttribute('action', newUrl);
                //console.log(form)
            })
        }


    });
</script> -->

@endsection