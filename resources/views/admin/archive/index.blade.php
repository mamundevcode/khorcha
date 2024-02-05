@extends('layouts.admin')
@section('content')
  @php
    $all_income=App\Models\Income::select(DB::raw('count(*) as total'),DB::raw('YEAR(income_date) year,MONTH(income_date) month'))->groupby('year','month')->orderBy('income_date','DESC')->get();
    $all_expense=App\Models\Expense::select(DB::raw('count(*) as total'),DB::raw('YEAR(expense_date) year,MONTH(expense_date) month'))->groupby('year','month')->orderBy('expense_date','DESC')->get();
  @endphp     
<div class="row">
  <div class="col-md-12">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-8 card_title_part">
            <i class="fab fa-gg-circle"></i>Income Expense Archive
          </div>
          <div class="col-md-4 card_button_part">
            <a href="{{url('dashboard/income')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>Add Income</a>
            <a href="{{url('dashboard/expense')}}" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>Add Expense</a>
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
        <table id="allTableinfo" class="table table-bordered table-striped table-hover custom_table">
          <thead class="table-dark">
            <tr>
              <th>Month</th>
              <th>Income</th>
              <th>Expense</th>
              <th>Savings</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>
            @foreach($all_income as $income)
            <tr>
              <td>
                @php
                  $year=$income->year;
                  $month=$income->month;
                  $year_month=$year.'-'.$month;
                  $month_year=date('F-Y', strtotime($year_month));
                  echo $month_year;
                @endphp
              </td>
              <td>
                @php
                  $total_income=App\Models\Income::where('income_status',1)->whereYear('income_date','=',$year)->whereMonth('income_date','=',$month)->sum('income_amount');
                  echo number_format($total_income,2);
                @endphp
              </td>
              <td>
                @php  
                  $total_expense=App\Models\Expense::where('expense_status',1)->whereYear('expense_date','=',$year)->whereMonth('expense_date','=',$month)->sum('expense_amount');
                  echo number_format($total_expense,2);
                @endphp
              </td>
              <td>
                @php
                  $total_savings=($total_income - $total_expense);
                  echo number_format($total_savings,2);
                @endphp
              </td>
              <td>
                <div class="btn-group btn_group_manage" role="group">
                  <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url('dashboard/archive/'.$month_year)}}">Details</a></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach    
          </tbody> 
        </table>  
      </div>
          <div class="card-footer">
            <div class="btn-group" role="group" aria-label="Button group">
              <button type="button" onclick="window.print()" class="btn btn-sm btn-dark">Print</button>
              <a href="{{url('dashboard/income/pdf')}}" class="btn btn-sm btn-secondary">PDF</a>
              <a href="{{url('dashboard/income/excel')}}" class="btn btn-sm btn-dark">Excel</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--delete Modal code-->
    <div class="modal fade" id="softdeleteModal" tabindex="-1" aria-labelledby="softDeleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="post" action="{{url('dashboard/income/softdelete')}}">
          @csrf
          <div class="modal-content modal_content">
          <div class="modal-header modal_header">
              <h1 class="modal-title modal_title" id="softDeleteModalLabel"><i class="fab fa-gg-circle"></i>Confirm Message</h1>     
            </div>
            <div class="modal-body modal_body">
              Are you want to sure delete data?
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
    @endsection