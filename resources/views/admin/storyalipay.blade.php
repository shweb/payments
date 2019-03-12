@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-default">Payment via alipay</div>
                <br>
                <br>
                <div class="panel-body" id="message">
                    <div class="col-md-12"><p style="color:#ff0000;">The end date must be superior on the start date.</p></div>
                </div>

                <div class="panel-body" id="generale">
                    <div class="table-responsive users-table">
                        <table class="table table-striped table-condensed data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>PROVIDER</th>
                                <th>BOOKING ID</th>
                                <th>AMOUNT</th>
                                <th>STATUS</th>
                                <th>OUT TRADE NO</th>
                                <th>TRADE NO</th>
                                <th>SELLER ID</th>
                                <th>DATE PAYMENT</th>
                            </tr>
                            </thead>
                            @php $nb=1; @endphp
                            @foreach($payments as $p)
                                <tr>
                                    <td>{{$nb}}</td>
                                    <td>{{$p->provider}}</td>
                                    <td>{{$p->booking}}</td>
                                    <td>{{$p->total_amount}}</td>
                                    <td>{{$p->status}}</td>
                                    <td>{{ $p->out_trade_no }}</td>
                                    <td>{{ $p->trade_no }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->timestamp)->format('d M Y')}}</td>
                                </tr>
                                @php $nb++; @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
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
    @if (count($payments) > 10)
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