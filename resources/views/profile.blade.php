@extends('layouts.app')

@section('content')
<profile-form-component csrf-token="{{ csrf_token() }}" :user="{{ auth()->user() }}"></profile-form-component>
@endsection
