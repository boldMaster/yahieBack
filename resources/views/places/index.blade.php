@extends('app')
@section('extraNav')

@endsection
@section('extraStyle')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection
@section('content')
    <div class = "row">
        <div class = "offset-s2 s6">
            <a href="insert" class="waves-effect waves-light btn"><i class="small material-icons left">note_add</i>Add New Places</a>
        </div>
    </div>
    <div class="row">
        @foreach($arrPlaces as $place)
        <div class="col s12 m6">
            <div class="card">
                @if($place['picture_path'] !== "")
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="responsive-img activator" src="http://i.telegraph.co.uk/multimedia/archive/02465/arpita_patra_2465947k.jpg">
                </div>
                @endif
                <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4 mobile-text">{{$place['place_title']}}<i class="material-icons right">more_vert</i></span>
                    <p><a href="{{$place['place_id']}}/edit">Edit Places</a></p>
                </div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">{{$place['place_title']}}<i class="material-icons right">close</i></span>
                    <p>{{$place['place_desc']}}</p>
                    <p class="text-grey">Contact: {{$place['contact']}}
                                        </br>
                                         Address: {{$place['place_address']}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($errors->any())
        <div class="alert error-text">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('extraScript')

@endsection