@extends('layouts.app')

@section('content')
    <div class="container">
        <model-component :id="{{ $id }}"></model-component>
    </div>
@endsection
