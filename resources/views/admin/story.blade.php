@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading panel-default">Payment via wechat</div>
                <div class="panel-body">
                    <table class="table table-responsive">
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
@endsection