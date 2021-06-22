@extends('layouts.app')

@section('content')
<router-view api_token='{{$api_token}}'></router-view>
@endsection
