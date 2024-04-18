@extends('layouts.default')

@section('content')

{{-- model start here  --}}

@if(Session::has('success'))
  <p class="alert {{ Session::get('alert-success', 'alert-info') }}">{{ Session::get('success') }}</p>
@endif

@if(Session::has('warning'))
  <p class="alert {{ Session::get('alert-danger', 'alert-danger') }}">{{ Session::get('warning') }}</p>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="row">
<div class="form-group col-5">
<form action="/tambah" method="GET" role="search">
  @csrf
<div class="input-group">
  <input type="text" name="search" id="search" placeholder="Please insert the TM Application number!" class="form-control" @error('search') is-Invalid @enderror onfocus="this.value=''">                            
</span>
</div>
</form>
</div>
</div>

<!--<div class="row">
<div class="form-group col-2">

<div class="table-responsive">
<table class="table">
<thead>
    <tr>
        <th class="text-left" style="width: 5%">Data</th>
    </tr>
</thead>
<tbody>
    <tr scope="row">
        <td class="text-left" id="outp"></td>
    </tr>
</tbody>
</table>-->

<div id="search_list"></div>

<script> 
$(document).ready(function() {
  $("#search").keyup(function() {
    //$("#outp").html($(this).val());
  //});*/
    var query = $(this).val();
    //alert(query);
    $.ajax({
                url:"search",
                type:"GET",
                data:{'search':query},
                success:function(data){ 
                    $('#search_list').html(data);
                }
            });
  });
});

</script>

@endsection

@section('heading','Add New Record')