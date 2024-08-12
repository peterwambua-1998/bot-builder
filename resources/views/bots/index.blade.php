@extends('layouts.app')

@section('content')

<nav class="page-breadcrumb" style="display:flex">
    <ol class="breadcrumb" style="width: 85%">
      <li class="breadcrumb-item"><a href="#">Bot</a></li>
      <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
    @if($bots->count() > 0)
    <div style="width: 15%">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" style="width: 100%"><ion-icon style="position: relative; top:3px; right: 5px; color: #fff; font-size: 16px;" name="add-circle-outline"></ion-icon> Create Bot</button>
    </div>
    @endif
</nav>

@include('error-display')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card " >
        <div class="row w-100">
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

            @if($bots->count() == 0)
            <div class="text-center" >
                <h3>Create your first bot</h3>
                <p class="text-muted"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#" style="color: #1389fe; font-weight:bolder">click here</a> to create bot</p>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('bots.store')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bot Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body row">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Bot name</label>
                        <input type="text" class="form-control" name="name" placeholder="Bot name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
