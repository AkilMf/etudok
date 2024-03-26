@extends('layouts.app')
@section('title', trans('New Student'))
@section('content')


<div class="container mt-3" >
    <div class="text-center mb-2 mt-5">
        <h3>@lang('New Student')</h3>
        <p class="text-muted">@lang('lang.text_form_student')</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form method="POST" action="{{ route('etudiant.store')}}" style="width:50vw; min-width:300px;">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="nom">@lang('name'):</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="@lang('add_name')"
                        value="{{ old('nom')}}">
                    @if($errors->has('nom'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('nom') }}
                    </div>
                    @endif
                </div>
                <div class="col">
                    <label class="form-label" for="email">@lang('Email') :</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="@lang('lang.text_placeH_mail')"  value="{{ old('email')}}">
                    @if($errors->has('email'))
                    <div class=" text-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>

            </div>

            <!-- password & confiramtion-->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="password">@lang('Password'):</label>
                    <input type="password" class="form-control" id="password" minlength="6" maxlength="20" name="password" placeholder="@lang('lang.text_placeH_mail')" required>
                    @if($errors->has('password'))
                    <div class="text-danger mt-2">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>
                <div class="col">
                    <label class="form-label" for="password_confirmation">@lang('Confirm Password') :</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="@lang('lang.text-placeholder_psw')" required>
                    @if($errors->has('password_confirmation'))
                    <div class=" text-danger mt-2">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                    @endif
                </div>

            </div>

            <div class=" form-group">
                <label for="date_naissance">@lang('Date of birth')  :</label>
                <input type="date" class="form-control" name="date_naissance" id="date_naissance"
                    placeholder="@lang('Format_date')" value="{{ old('date_naissance')}}">
                @if($errors->has('date_naissance'))
                <div class=" text-danger mt-2">
                    {{ $errors->first('date_naissance') }}
                </div>
                @endif
            </div>
            <div class="form-group">
                <label for="adresse" for="adresse">@lang('Address'):</label>
                <textarea name="adresse" id="adresse" cols="30" rows="5"
                    class="form-control"> {{ old('adresse')}}</textarea>
                @if($errors->has('adresse'))
                <div class="text-danger mt-2">
                    {{ $errors->first('adresse') }}
                </div>
                @endif

            </div>
            <div class="mb-3">
                <label class="form-label" for="telephone">@lang('Phone'):</label>
                <input type="text" class="form-control" name="telephone" placeholder="+1 999 9999 909"
                    value="{{ old('telephone') }}">
                @if($errors->has('telephone'))
                <div class=" text-danger mt-2">
                    {{ $errors->first('telephone') }}
                </div>
                @endif
            </div>



            <div class="form-group">
                <label for="addEmail">@lang('City') :</label>
                <select name="ville_id" id="" class="form-control custom-select" value="{{ old('ville_id')}}">
                    @foreach($villes as $ville)
                    <option value="{{$ville->id}}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>{{$ville->nom}}
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
                <button type="submit" class="btn btn-success">@lang('Save')</button>
                <a href="{{route('etudiant.index')}}" class="btn btn-danger">@lang('Cancel')</a>
            </div>
        </form>
    </div>
</div>

@endsection