@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-default">Payment via wechat</div>
                <br>
                <br>
                <div class="panel-body" id="message">
                    <div class="col-md-12"><p style="color:#ff0000;">The end date must be superior on the start date.</p></div>
                </div>

                <div class="panel-body">
                    <div class="col-md-3">Payments date</div>
                    <form role="form" method="POST" action="resutl_search">
                        {{ csrf_field() }}
                        <input type="hidden" name="title" value="payment">
                        <div class="col-md-3"><input type="texte" name="debut" id="datepicker" placeholder="start date" value=" @if(strcmp($title,"created_at")==0)@if(isset($date_debut)) {{$date_debut}} @endif @endif "></div>
                        <div class="col-md-3"><input type="texte" name="fin" id="datepicker1" placeholder="end date" value="@if(strcmp($title,"created_at")==0) @if(isset($date_fin)) {{$date_fin}} @endif @endif "></div>
                        <div class="col-md-3"><button class=" btn btn-primary" type="submit" id="search">Search</button></div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="col-md-3">Booking date</div>
                    <form role="form" method="POST" action="resutl_search">
                        {{ csrf_field() }}
                        <input type="hidden" name="title" value="booking">
                        <div class="col-md-3"><input type="texte" name="debut" id="datepicker2" placeholder="start date" value="@if(strcmp($title,"booking_date")==0)@if(isset($date_debut)) {{$date_debut}} @endif @endif"></div>
                        <div class="col-md-3"><input type="texte" name="fin" id="datepicker3" placeholder="end date" value="@if(strcmp($title,"booking_date")==0) @if(isset($date_fin)) {{$date_fin}} @endif @endif"></div>
                        <div class="col-md-3"><button class=" btn btn-primary" type="submit" id="search1">Search</button></div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="col-md-9"></div>
                    <div class="col-md-3"><a href="{{url('/')}}/admin/wechat" class=" btn btn-danger" type="submit" id="search1">Clear search</a></div>
                </div>
                <!--resultat search-->
                @if(isset($data))
                    <div class="panel-body" id="result">
                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>PROVIDER</th>
                                    <th>BOOKING ID</th>
                                    <th>AMOUNT</th>
                                    <th>STATUS</th>
                                    <th>TRANSACTION ID</th>
                                    <th>BOOKING NAME</th>
                                    <th>BOOKING DATE</th>
                                    <th>BANK TYPE</th>
                                    <th>DATE PAYMENT</th>
                                </tr>
                                </thead>
                                @php $nb=1; @endphp
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->provider}}</td>
                                        <td>{{$d->booking}}</td>
                                        <td>{{$d->amount}}</td>
                                        <td>{{$d->status}}</td>
                                        <td>{{$d->transaction_id}}</td>
                                        <td>{{$d->booking_name}}</td>
                                        @if(isset($d->booking_date))
                                            <td>{{ \Carbon\Carbon::parse($d->booking_date)->format('d M Y')}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$d->bank_type}}</td>
                                        <td>{{ \Carbon\Carbon::parse($d->created_at)->format('d M Y')}}</td>
                                    </tr>
                                    @php $nb++; @endphp
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
                <!--resultat search-->
            </div>
        </div>
    </div>
@endsection

@section('specificScript')
    <script>
        $(document).ready(function () {
            $('#message').hide();
        });
        $( function() {
            $('#datepicker').datepicker({dateFormat: 'yy-mm-dd',});
            $('#datepicker1').datepicker({dateFormat: 'yy-mm-dd',});
            $('#datepicker2').datepicker({dateFormat: 'yy-mm-dd',});
            $('#datepicker3').datepicker({dateFormat: 'yy-mm-dd',});
        } );
        $('#search').click(function () {
            var dd1 = $('#datepicker').val();
            var df1 = $('#datepicker1').val();
            var dd = new Date(dd1);
            var df = new Date(df1);

            console.log(dd + "/////" + df);
            if (df <= dd) {
                $('#message').show();
                $('#generale').show();
                return false;
            }
            else{
                $('#generale').hide();
            }

        });
        $('#search1').click(function () {
            var dd1 = $('#datepicker2').val();
            var df1 = $('#datepicker3').val();
            var dd = new Date(dd1);
            var df = new Date(df1);
            console.log(dd + "/////" + df);
            if (df <= dd) {
                $('#message').show();
                $('#generale').show();
                return false;
            }
            else{
                $('#generale').hide();
            }

        });

    </script>
    @if (count($data) > 10)
        <script src="{{ url('/') }}/public/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('/') }}/public/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.data-table').dataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "dom": 'T<"clear">lfrtip',
                    "sPaginationType": "full_numbers",
                    'aoColumnDefs': [{
                        'bSortable': false,
                        'searchable': false,
                        'aTargets': ['no-search'],
                        'bTargets': ['no-sort']
                    }]
                });
            });
        </script>
    @endif

@endsection