@extends('layouts.app')
@section('title', 'Liste Documents')
@section('content')



<!-- Person Table -->

<div class="container">
    <a href="{{route('fichier.create')}}" class="btn btn-dark mb-3">@lang('New') Document</a>

    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>

                <th scope="col">@lang('Name')</th>
                <th scope="col">Date</th>
                <th scope="col">@lang('Author')</th>
                <th scope="col">Document</th>
                <th scope="col">@lang('Display')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fichiers as $fichier)
            <tr>
                <td>{{ $fichier['titre']}}</td>
                
                <td>{{$fichier['date']}}</td>
                <td>{{ $fichier['etudiant']}}</td>
                <td><a href="{{ asset('fichiers/' . $fichier['file'])}}" target="_blank">{{$fichier['file']}}</a></td>
                <td>
                    <a href="{{route('fichier.show', $fichier['id'])}}"><i title="Afficher"
                            class=" link-dark fa fa-eye me-3"></i>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
   
    <div class="mt-8">
        {{ $fichiers->withPath(url()->current())->links() }}
    </div>

</div>

<!-- Delete Modal HTML -->
<!--     <div id="suppression" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title">Êtes-vous sûr ?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment le supprimer ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>


                    <form action="{{ route('etudiant.delete', 'etudiantID')}}" method="POST" class="deleteForm">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->

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