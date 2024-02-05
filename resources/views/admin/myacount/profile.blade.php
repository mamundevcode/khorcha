@extends('layouts.admin')
@section('content')
<div class="row">   
    <div class="col-md-12 welcome_part">
        <p><span>Welcome </span> {{Auth::user()->name}}</p>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-12">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12 card_title_part">
            <i class="fab fa-gg-circle"></i>My profile
          </div>
        </div>
      </div>
      <div class="card-body">
        hello My name is Mamun Mia i'm developer from creative pathsala 
        </div>
      <div class="card-footer">
        
      </div>
    </div>
  </div>
</div>
@endsection