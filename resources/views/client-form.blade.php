@extends('layouts.app')
@section('title', 'Client Form')

@section('content')
<client-form :client="{{$client}}"></client-form>
@endsection