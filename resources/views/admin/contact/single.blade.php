@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Contact Message</h4>
        <ul>
            <li>Name: {{$contact->name}}</li>
            <li>Phone: {{$contact->phone}}</li>
        </ul>

        <div class="shadow-lg p-3 mb-5 bg-body rounded">{{$contact->message}}</div>
        
    </div>

</div>
@endsection