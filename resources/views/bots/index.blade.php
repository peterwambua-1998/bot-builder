@extends('layouts.app')

@section('content')

<nav class="page-breadcrumb" style="display:flex">
    <ol class="breadcrumb" style="width: 85%">
      <li class="breadcrumb-item"><a href="#">Parents</a></li>
      <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
   
    <div style="width: 15%">
        <button type="button" class="btn btn-primary" style="width: 100%"><ion-icon style="position: relative; top:3px; right: 5px; color: #fff; font-size: 16px;" name="add-circle-outline"></ion-icon> Create Bot</button>
    </div>
</nav>


@include('error-display')

<div class="container">
    <div class="row justify-content-center">
        @foreach ($bots as $bot)
            
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{$bot->name}}</div>

                <div class="card-body">
                    <button>Edit</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
