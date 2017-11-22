@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-default">Payment via wechat</div>
                <div class="panel-body">
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
                                <th>BANK TYPE</th>
                                <th>DATE PAYMENT</th>
                            </tr>
                            </thead>
                            @foreach($payments as $p)
                                <tr>
                                    <td>{{$p->id}}</td>
                                    <td>{{$p->provider}}</td>
                                    <td>{{$p->booking}}</td>
                                    <td>{{$p->amount}}</td>
                                    <td>{{$p->status}}</td>
                                    <td>{{$p->transaction_id}}</td>
                                    <td>{{$p->bank_type}}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y')}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('specificScript')
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