@extends('layouts.admin')
@section('content')
<div class="row">
<div class="col-md-12 ">
    <form method="post" action="{{url('dashboard/manage/contact/update')}}" enctype="multipart/form-data">
    @csrf 
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-8 card_title_part">
                    <i class="fab fa-gg-circle"></i>Contact Information
                </div>  
                <div class="col-md-4 card_button_part">
                    <a href="{{url('dashboard/manage/basic')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>Basic Information</a>
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
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                        <input type="text" class="form-control" name="phone1" value="{{$data->ci_phone1}}" />
                      </div>
                    </div>
                  
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                        <input type="text" class="form-control" name="phone2" value="{{$data->ci_phone2}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                        <input type="text" class="form-control" name="phone3" value="{{$data->ci_phone3}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
                        <input type="text" class="form-control" name="phone4" value="{{$data->ci_phone4}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                        <input type="text" class="form-control" name="email1" value="{{$data->ci_email1}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                        <input type="text" class="form-control" name="email2" value="{{$data->ci_email2}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                        <input type="text" class="form-control" name="email3" value="{{$data->ci_email3}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                        <input type="text" class="form-control" name="email4" value="{{$data->ci_email4}}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        <textarea class="form-control" name="address1" row="">{{$data->ci_address1}}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        <textarea class="form-control" name="address2" row="">{{$data->ci_address2}}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        <textarea class="form-control" name="address3" row="">{{$data->ci_address3}}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                        <textarea class="form-control" name="address4" row="">{{$data->ci_address4}}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
              </div>  
            </div>
          </form>
        </div>
      </div>
    @endsection