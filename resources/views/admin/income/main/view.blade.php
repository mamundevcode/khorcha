@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8 card_title_part">
            <i class="fab fa-gg-circle"></i>View Income Information
          </div>
          <div class="col-md-4 card_button_part">
            <a href="{{url('dashboard/income')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Category</a>
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
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table class="table table-bordered table-striped table-hover custom_view_table">
            <tr>
                <td>Title</td>
                <td>:</td>
                <td>{{$data->income_title}}</td>
              </tr>
              <tr>
            <tr>
                <td>Category</td>
                <td>:</td>
                <td>{{$data->categoryInfo->incate_name}}</td>
              </tr>
              <tr>
                <td>Date</td>
                <td>:</td>
                <td>{{date ('d-m-Y',strtotime($data->income_date))}}</td>
              </tr>
              <tr>

              <tr>
                <td>Amount</td>
                <td>:</td>
                <td>{{number_format($data->income_amount,2)}}</td>
              </tr>
              <tr>

                <td>Creator Info</td>
                <td>:</td>
                <td>
                    {{$data->creatorinfo->name}}<br>
                  {{$data->created_at->format('d-m-y |H:i:s A')}}                
                </td>
              </tr>
             
              @if($data->income_editor!='')
              <tr>
                <td>Editor Info</td>
                <td>:</td>
                <td>
                  {{$data->editorinfo->name ??''}}<br>
                  
                </td>
              </tr>
              @endif
              
              @if($data->updated_at!='')
              <tr>
                <td>Update Duration</td>
                <td>:</td>
                <td>{{$data->updated_at->diffForHumans()}}</td>
              </tr>
              @endif
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
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
@endsection