@extends('layouts.app')
@section('title', 'Grant Access')
@section('content')
<grant-access class="mt-3" :users="{{$users}}"></grant-access>
@endsection
