@extends('layouts.default')
@section('content')
@if(Session::has('success'))
        <p class="alert {{ Session::get('alert-success', 'alert-info') }}">{{ Session::get('success') }}</p>
@endif
<div class="d-flex justify-content-center">
<table id="example" class="table table-striped table-hover" style="width:100%">
  <thead>
      <tr>
        <th>#</th>
        <th>User</th>
        <th>Application Number</th>
        <th>Action</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
  </thead>
  <tbody>
    @foreach($aktiviti as $per)
      <tr>
        <td>{{ $per->id }}</td>
        <td>{{ $per->user }}</td>
        <td>{{ $per->nrproc }}</td>
        <td>
          @if($per->activity_code == 1)
          <span class="badge bg-info text-dark">Insert</span> 
          @else
          <span class="badge bg-danger">Delete</span>
          @endif
        </td>
        <td>{{ date('d M Y', strtotime($per->created_at)); }}</td>
        <td>
          @if($per->status == 0)
          Failed!
          @else
          <span class="badge bg-success">OK!</span>
          @endif
        </td>
      </tr>
      @endforeach
  </tbody>
  <tfoot>
      
  </tfoot>
</table>
</div>
@endsection

@section('heading','History')