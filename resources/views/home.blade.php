@extends('layout/app', ['title' => 'home'])

@section('head')
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
@endsection

@section('scripts')
@endsection
