@extends('layouts.app')
@section('content')
@include('inc.header')
<link href="/css/daterangepicker.css" rel="stylesheet">
<script type="text/javascript"  src ="{{url('js/bootstrap.js')}}"></script>
<link   rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<script type="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                   @if (session('status'))
                       <div class="alert alert-success">
                           {{ session('status') }}
                       </div>
                   @endif

   <div class="container">

   <div class="row">
       <div class="col-md-8 col-md-offset-2">
           <div class="panel panel-default">
               <div class="panel-heading">Reports</div>
                  <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif  
                    <!-- <form method="POST" action="{{ url('report') }}" class="form-horizontal">
                        <input type="text" name="daterange" class="form-control" placeholder="Custom Date or Range"><br>
                         <input type="submit" name="submit" class="btn btn-primary form-control">
                        {!! csrf_field() !!}
                    </form><hr> -->
                  @if($ndata)
                     <?php $total=0?>
                     @foreach($ndata as $item)
                      <?php $total += $item->amount;
                      ?>
                    @endforeach
                    @endif 
                    <div class="text-center alert alert-warning" role="alert"><h2><strong>
                    
                     Total Sales: {{ $total }} KsH
                   </strong></h2> </div>
                   <div class="text-center alert alert-success" role="alert"><h2><strong>
                    <a class="btn"  href="http://127.0.0.1:8000/subscriptions">
                     Click here to filter BY Class</a>
                   </strong></h2> </div>

<!-- Filter By Class Name -->
 <form method="POST" action="">
  <label for ="class_name">Class</label>
  <select name ="class_name">
    <option value ="">Show All</option>
    @foreach ($ndata as $item)
    <option value="{{$item->class_name}}" >{{ $item->class_name}}</option>
    @endforeach
</form>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Filter</button>
                   <br>
            <hr>

                     <!-- Search -->
  <form action="{{ ('reportsController@search') }}" role="search" method="get">
       <div class="input-group">
        <input type="text" class="form-control" name="search"
            placeholder="Search Book Name">
             <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search">
                  
                </span>
            </button>
        </span>
    </div>
</form>
                    <table class="table" id="subscriptions">
                        <thead>
                          <th>Id</th>
                          <th>Book Name</th>
                          <th>Client</th>
                          <th>Amount</th>
                          <th>Created At</th>
                        </thead>
                        <tbody>
                            @if($ndata)
                                <?php $n=1; ?>
                                @foreach($ndata as $item)
                                  <tr>
                                  <td>{{ $n }}</td>
                                  <td>{{ $item->Book_name }}</td>
                                  <td>{{ $item->client_contact }}</td>
                                  <td>{{ $item->amount }}</td>
                                  <td>{{ $item->created_at }}</td> 
                                  </tr>
                                  <?php $n++;?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>    
                                          
                </div>
            </div>
          </div>
        </div>
      </div>

@endsection

@section('js')

$(document).ready( function () {
    $('#subscriptions').DataTable();

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('input[name="daterange"]').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
} );

@endsection