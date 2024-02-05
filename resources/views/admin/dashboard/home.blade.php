@extends('layouts.admin')
@section('content')
<div class="row">   
    <div class="col-md-12 welcome_part">
        <p><span>Welcome </span> {{Auth::user()->name}}</p>
    </div>
</div>
<div class="row mt-5">
  <div class="col-md-6">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12 card_title_part">
            <i class="fab fa-gg-circle"></i> {{$chart1->options['chart_title']}}
          </div>
        </div>
      </div>
      <div class="card-body">
      {!! $chart1->renderHtml() !!}
        </div>
      <div class="card-footer">
        
      </div>
    </div>
  </div>
</div>
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
@endsection