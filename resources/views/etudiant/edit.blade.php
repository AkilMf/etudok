@extends('layouts.app')
@section('title','Modification Etudiant')
@section('content')

<div class="container">
    <div class="text-center mb-4">
        <h3>Modifier les informations de l'etudiant</h3>
        <p class="text-muted">Cliquez sur "Mettre à jour" après avoir modifié des informations.</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="{{ route('etudiant.update',$etudiant->id)}}" method="post" style="width:50vw; min-width:300px;">
            @csrf
            @method('put')
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="nom">Nom:</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Saisissez votre nom"
                        value="{{ old('nom',$etudiant->nom)}}">
                    @if($errors->has('nom'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('nom') }}
                    </div>
                    @endif
                </div>
                <div class="col">
                    <label class="form-label" for="email">Courriel :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                        value="{{ old('email',$etudiant->email)}}">
                    @if($errors->has('email'))
                    <div class=" text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>


            </div>
            <div class=" form-group">
                <label for="date_naissance">Date Naissance :</label>
                <input type="date" class="form-control" name="date_naissance" id="date_naissance"
                    placeholder="1989-01-25" value="{{ old('date_naissance',$etudiant->date_naissance)}}">
                @if($errors->has('date_naissance'))
                <div class=" text-danger mt-2">
                    {{ $errors->first('date_naissance') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="adresse" for="adresse">Adresse:</label>
                <textarea name="adresse" id="adresse" cols="30" rows="5"
                    class="form-control"> {{ old('adresse',$etudiant->adresse)}}</textarea>
                @if($errors->has('adresse'))
                <div class="text-danger mt-2">
                    {{ $errors->first('adresse') }}
                </div>
                @endif

            </div>
            <div class="mb-3">
                <label class="form-label" for="telephone">Telephone:</label>
                <input type="text" class="form-control" name="telephone" placeholder="+1 999 9999 909"
                    value="{{ old('telephone',$etudiant->telephone) }}">
                @if($errors->has('telephone'))
                <div class=" text-danger mt-2">
                    {{ $errors->first('telephone') }}
                </div>
                @endif
            </div>



            <div class="form-group">
                <label for="addEmail">Ville :</label>
                <select name="ville_id" id="" class="form-control custom-select"
                    value="{{ old('ville_id',$etudiant->ville_id)}}">
                    @foreach($villes as $ville)
                    <option value="{{$ville->id}}" {{ old('ville_id',$etudiant->ville_id) == $ville->id ?
                        'selected':''}}>
                        {{ $ville->nom }}
                    <option>
                        @endforeach
                </select>
                @if($errors->has('ville_id'))
                <div class="text-danger mt-2">
                    {{ $errors->first('ville_id') }}
                </div>
                @endif

            </div>


            <div class="mt-3">
                <button type="submit" class="btn btn-success" name="submit">Mettre à jour</button>
                <a href="{{route('etudiant.index')}}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection