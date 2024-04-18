@extends('layouts.default')

@section('content')

@if(Session::has('success'))
        <p class="alert {{ Session::get('alert-success', 'alert-info') }}">{{ Session::get('success') }}</p>
@endif

@if(Session::has('warning'))
  <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}">{{ Session::get('warning') }}</p>
@endif
<div class="d-flex justify-content-center">
<table id="example" class="table table-striped" style="width:auto;">
  <thead>
      <tr>
        <th> # </th>
        <th>Application Number</th>
        <th>Denomination</th>
        <th>Applicant/Owner</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody>

    @if(!$list)
        {{ dd('Data is Empty!') }}
    @else
        @foreach($list as $per)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
  
          <a href="#" class="show_user_details" data-bs-toggle="modal" data-bs-target="#UserDetailsModal" data-tooltips="{{ $per->tooltips }}">
                    {{ $per->nrproc }}
          </a>


        <!-- Modal -->
        <div class="modal fade" id="UserDetailsModal" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="UserDetailsModalLabel">{{__('TM Application Information')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p><span class="tooltips"></span></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        </td>

        <td>{{ $per->denomark }}</td>
        <td>
            <sup>Will be updated soon.</sup>
        </td>
        <td>{{ $per->description }}</td>
        <td>
            <a href="{{ url('delete/'.$per->nrproc) }}" onclick="return confirm('Are you sure to removed it?');"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
        </td>
      </tr>
        @endforeach
    @endif

  </tbody>
</table>
</div>
@endsection

@section('heading','Excluded Job Automation of TM Applications Record')