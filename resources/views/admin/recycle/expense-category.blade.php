@extends('layouts.admin')
@section('content')

@php
$all=App\Models\ExpenseCategory::where('expcate_status',0)->orderBy('expcate_id','DESC')->get();
@endphp
<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8 card_title_part">
            <i class="fab fa-gg-circle"></i>Recycle Expense Category Information
          </div>
          <div class="col-md-4 card_button_part">
            <a href="{{url('dashboard/recycle')}}" class="btn btn-sm btn-dark"><i class="fas fa-plus-circle"></i>Recycle Bin</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            @if(Session::has('success'))
            <div class="alert alert-success alert_success" role="alert">
              <strong>Success!</strong> {{Session::get('success')}}
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert_error" role="alert">
              <strong>Opps!</strong> {{Session::get('error')}}
            </div>
            @endif
          </div>
          <div class="col-md-2"></div>
        </div>
        <table class="table table-bordered table-striped table-hover custom_table">
          <thead class="table-dark">
            <tr>
              <th>Name</th>
              <th>Remarks</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all as $data)
            <tr>
              <td>{{$data->expcate_name}}</td>
              <td>{{$data->expcate_remarks}}</td>

              <td>
              <li><a href="#" id="restore" data-bs-toggle="modal" data-bs-target="#restoreModal" data-id="{{$data->expcate_id}}"><i class="fas fa-recycle fs-5 text-success fw-bold mx-6"></i></a></li>
              <li><a href="#" id="delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{$data->expcate_id}}"><i class="fas fa-trash fs-5  text-danger fw-bold mx-6"></i></a></li>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        <div class="btn-group" role="group" aria-label="Button group">
          <button type="button" class="btn btn-sm btn-dark">Print</button>
          <button type="button" class="btn btn-sm btn-secondary">PDF</button>
          <button type="button" class="btn btn-sm btn-dark">Excel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- restore Modal code -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/expense/category/restore')}}">
      @csrf
      <div class="modal-content modal_content">
      <div class="modal-header modal_header">
          <h1 class="modal-title modal_title" id="restoreModalLabel"><i class="fab fa-gg-circle"></i>Confirm Message</h1>     
        </div>
        <div class="modal-body modal_body">
          Are you want to sure restore data?
          <input type="hidden" name ="modal_id" id ="modal_id">
        </div>
        <div class="modal-footer modal_footer">
          <button type="submit" class="btn btn-sm btn-success">Confirm</button>
          <button type="button" class="btn btn-sm btn-danger"data-bs-dismiss="modal">Close</button>
        </div>
      </div>
  </form>
  </div>
</div>

<!-- delete Modal code -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{url('dashboard/expense/category/delete')}}">
      @csrf
      <div class="modal-content modal_content">
      <div class="modal-header modal_header">
          <h1 class="modal-title modal_title" id="deleteModalLabel"><i class="fab fa-gg-circle"></i>Confirm Message</h1>     
        </div>
        <div class="modal-body modal_body">
          Are you want to sure permanent delete data?
          <input type="text" name ="modal_id" id ="modal_id">
        </div>
        <div class="modal-footer modal_footer">
          <button type="submit" class="btn btn-sm btn-success">Confirm</button>
          <button type="button" class="btn btn-sm btn-danger"data-bs-dismiss="modal">Close</button>
        </div>
      </div>
  </form>
  </div>
</div>
@endsection