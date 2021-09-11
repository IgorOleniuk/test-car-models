@extends('layouts.app')

@section('content')
<div class="container">
    @if ( session('message') )
        <div class="alert alert-success alert-dismissible">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <brand-component></brand-component>
</div>
@endsection
