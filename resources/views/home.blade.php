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
        <th>No. Cap Dagangan</th>
        <th>Denominasi</th>
        <th>Jenis Permohonan</th>
        <th>Status</th>
        <th>Tindakan</th>
      </tr>
  </thead>
  <tbody>

    @if(!$list)
        {{ dd('Data is Empty!') }}
    @else
        @foreach($list as $per)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $per->nrproc }}
 <!--         <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ $per->nrproc }}
          </a>-->
        
        <!-- Modal -->
<!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{ $per->nrproc}}
        {{ $per->dtfilling}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
-->
        
        
        </td>
        <td>{{ $per->denomark }}</td>
        <td>
            @if($per->ctryorigin == 'MY')
            Tempatan
            @elseif($per->ctryorigin == NULL)
            -
            @else
            Antarabangsa
            @endif
        </td>
        <td>{{ $per->description }}</td>
        <td>
            <a href="{{ url('delete/'.$per->nrproc) }}" onclick="return confirm('Sila tekan OK untuk teruskan?');"><i class="fa fa-trash" aria-hidden="true"></i>Padam</a>
        </td>
      </tr>
        @endforeach
    @endif

  </tbody>
</table>
</div>
@endsection

@section('heading','Rekod Aplikasi Cap Dagangan yang dikecualikan Job secara Automasi')