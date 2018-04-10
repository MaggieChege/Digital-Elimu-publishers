@extends('layouts.app')
@section('content')
@include('inc.header')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <h2 style="text-align: center;"> <strong>Welcome:{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</strong>


                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div></h2>
                       <!-- VERY IMPOTANT -->
    <div class="panel-body">
                    <h2>Sales Breakdown</h2><hr>
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Sales Today:</h3>
                                </div>
                              <div class="panel-body">
                                {{$daily}} Ksh
                              </div>                              
                            </div> 
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-success"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales Yesterday</h3> 
                            </div> 
                            <div class="panel-body"> {{$yesterday}} Ksh </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-info"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales This Week</h3> 
                            </div> 
                            <div class="panel-body"> {{$thisWeek}} Ksh </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-warning"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales Last Seven Days</h3> 
                            </div> 
                            <div class="panel-body"> {{$lastSevenDaysSales}} Ksh </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-danger"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales This Month</h3> 
                            </div> 
                            <div class="panel-body"> {{$salesThisMonth}} Ksh </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-info"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales This Year</h3> 
                            </div> 
                            @if($data)
                     <?php $total=0?>
                     @foreach($data as $item)
                      <?php $total += $item->amount;
                      ?>
                    @endforeach
                    @endif
                            <div class="panel-body">  {{ $total }} KsH </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-info"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales Last Year</h3> 
                            </div> 
                            <div class="panel-body"> {{$salesLastYear}} Ksh </div> 
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-6 ">
                          <div class="panel panel-info"> 
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Sales Last Month</h3> 
                            </div> 
                            <div class="panel-body"> {{$salesLastMonth}} Ksh </div> 
                          </div>
                        </div>
        </div>
    </div>
            </div>

</div>
@endsection
