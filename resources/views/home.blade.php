@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 h-100">
    <div class="row h-100">
        <div class="col-4">
            <contacts-list-component></contacts-list-component>   
        </div>
        <div class="col-8 h-100">
            <active-conversation-component></active-conversation-component>
        </div>
    </div>
</div>
@endsection
