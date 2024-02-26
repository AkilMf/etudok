@extends('layouts.app')
@section('title','Etudiant')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- student Card -->
            <div class="card profile-card">
                <img src="https://via.placeholder.com/150" class="card-img-top profile-image" alt="User Image">
                <div class="card-body profile-content">
                    <h5 class="card-title">{{$etudiant->nom}}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- student Information -->
            <div class="card user-info-card">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Informations Etudiant</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Courriel:</strong> {{$etudiant->email}}</li>
                        <li class="list-group-item"><strong>Telephone:</strong> {{$etudiant->telephone }}</li>
                        <li class="list-group-item"><strong>Date de naissance:</strong> {{$etudiant->date_naissance }}
                        </li>
                        <li class="list-group-item"><strong>Adresse:</strong> {{$etudiant->adresse }}</li>
                        @foreach($villes as $ville)
                        @if($ville['id'] == $etudiant->ville_id)
                        <li class="list-group-item"><strong>Ville:</strong> {{$ville['nom']}}</li>
                        @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection