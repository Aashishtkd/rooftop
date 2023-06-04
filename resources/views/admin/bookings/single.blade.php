@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
        
        <ul>


            <li>Name: {{$booking->name}}</li>
            <li>Phone: {{$booking->phone}}</li>
            <li>Location: {{$booking->time}}</li>
            <li>: @if($booking->completed =='true') <span class="badge badge-success">Complete</span> @else <span  class="badge badge-danger">Pending</span> @endif</li>
        </ul>

        <h5>booking items:</h5>
    
    </div>

</div>
@endsection