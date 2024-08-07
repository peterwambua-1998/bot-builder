@extends('layouts.app')
@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('content')

<nav class="page-breadcrumb" style="display:flex; justify-content: space-between">
    <ol class="breadcrumb" style="width: 85%">
      <li class="breadcrumb-item"><a href="{{route('bots.index')}}">Bot</a></li>
      <li class="breadcrumb-item active" aria-current="page">workflow</li>
    </ol>
   
</nav>

@include('error-display')



<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome message</h5>
                        <p class="card-text text-muted">add welcome message and dictate conversation directions with buttons.</p>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mt-2">Configure</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ai knowledge base</h5>
                        <p class="card-text text-muted">configure ai knowledge base to enable answering based on your own context.</p>
                        <button data-bs-toggle="modal" data-bs-target="#ai" class="btn btn-primary mt-2">Configure</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('bot.workflow.store')}}" method="post">
            @csrf
            <input type="hidden" name="bot_id" value="{{$bot->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Configure welcome message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body row">
                    {{-- node type of input with options --}}
                    <input type="hidden" name="node_type" value="1"> 

                    <div class="mb-4 col-md-12">
                        <label for="name" class="form-label">Define your welcome message</label>
                        <input type="text" class="form-control" name="message" autocomplete="off" placeholder="Ex: Hello you can checkout our products...">
                    </div>

                    <div class="mb-5 col-md-12">
                        <input type="checkbox" class="form-check-input" id="add_options" value="off">
                        <label class="form-check-label" for="checkDefault">
                        Add options to welcome message 
                        </label>
                    </div>

                    <div id="options_area" >
                        <div class="mb-4">
                            <div class="mb-2 col-md-12">
                                <label for="name" class="form-label">Define your welcome message</label>
                                <select name="Type[]" class="form-select">
                                    <option value="0">Choose option...</option>
                                    <option value="1">conversational</option>
                                    <option value="2">link</option>
                                </select>
                            </div>

                            <div class="mb-2 col-md-12">
                                <label for="name" class="form-label">Button value</label>
                                <input type="text" class="form-control" name="display_value[]" autocomplete="off" placeholder="Enter display value">
                            </div>
    
                            <div class="mb-2 col-md-12">
                                <label for="name" class="form-label">Button action</label>
                                <input type="text" class="form-control" name="value[]" autocomplete="off" placeholder="Enter value">
                            </div>
                        </div>

                        <div class="extra_buttons">
                            
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-xs" id="add_button">Add button</button>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
    <script defer>
        $(document).ready( function () {
            $('#options_area').hide();
            $('#add_options').on('click', () => {
                let add_options = $('#add_options').val()
                console.log(add_options);
                
                if (add_options) {
                    $('#options_area').show();
                } else {
                    $('#options_area').hide();
                }
            })

            $('#add_button').on('click', (e) => {
                let template = `
                    <div class="mb-3">
                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Define your welcome message</label>
                            <select name="Type[]" class="form-select">
                                <option value="0">Choose option...</option>
                                <option value="1">conversational</option>
                                <option value="2">link</option>
                            </select>
                        </div>

                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Button value</label>
                            <input type="text" class="form-control" name="display_value[]" autocomplete="off" placeholder="Enter display value">
                        </div>

                        <div class="mb-2 col-md-12">
                            <label for="name" class="form-label">Button action</label>
                            <input type="text" class="form-control" name="value[]" autocomplete="off" placeholder="Enter value">
                        </div>
                    </div>
                `;

                $('.extra_buttons').append(template)
            })
        } );

    </script>
@endpush