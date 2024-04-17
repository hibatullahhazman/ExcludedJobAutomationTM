@extends('layouts.default')
@section('content')
@if(Session::has('success'))
        <p class="alert {{ Session::get('alert-success', 'alert-info') }}">{{ Session::get('success') }}</p>
@endif
<div class="d-flex justify-content-center">
<table id="example" class="table table-striped" style="width:100%">
  <thead>
      <tr>
        <th> # </th>
        <th>User</th>
        <th>Nombor Pemfailan</th>
        <th>Tindakan dibuat</th>
        <th>Tarikh Direkodkan</th>
        <th>Status</th>
      </tr>
  </thead>
  <tbody>
    @foreach($aktiviti as $per)
      <tr>
        <td>{{ $per->id }}</td>
        <td>{{ $per->user }}</td>
        <td>{{ $per->nrproc }}</td>
        <td><i>
          @if($per->activity_code == 1)
          Insert 
          @else
          Delete
          @endif
        </i>
        </td>
        <td>{{ date('d M Y', strtotime($per->created_at)); }}</td>
        <td>
          @if($per->status == 0)
          Gagal
          @else
          OK!
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

@section('heading','Rekod Aktiviti yang telah dijalankan')