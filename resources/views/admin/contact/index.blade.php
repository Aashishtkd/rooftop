@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">All Orders</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Seen</th>
            <th scope="col">View</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <th scope="row">{{$contact->name}}</th>
                <th scope="row">{{$contact->phone}}</th>
                <th scope="row">@if($contact->seen) Seen @else Not Seen @endif</th>
                <td><a href="{{route('admin.contact.single', $contact->id)}}">View</a></td>
                <td><a href="{{route('admin.contact.delete', $contact->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection