@extends('home.includes.parent')
@section('content')
{{ Auth ::user()->name }}
    
@endsection