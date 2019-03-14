@extends("template")
@section("contenu")
    <section>
        <div class="container" id="success">
            <div class="separated hidden-xs "></div>

            <div class="col-md-8 col-md-offset-2">
                <div class="bg-custom2">
                    <div class="alert alert-success">
                        Payment successful !!!<br/>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 center">
                            <p style="font-size: 16px;">You will be redirected to uvbypp.cc soon....</p>
                            <p style="font-size: 16px;" id="counter">5</p>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>
@endsection
@section("script")
    <script>
        $.ajax({
            url: '{{url('/getPayementalipay')}}',
            type: 'GET',
            data: 'booking={{ $booking }}',
            success: function (data) {
                //var amount = data.split('|')[0];
                //var transaction = data.split('|')[1];
                //var date = data.split('|')[2];
                $.ajax({
                    url: 'https://preprod.uvbypp.cc/bkk/adminv2/index.php/alipay/callback',
                    type: 'GET',
                    data: 'booking={{ $booking }}&status=PAID&amount=' + {{ $total_amount }} + '&date=' + {{ $timestamp }} + '&transaction=' + {{ $trade_no }},
                    datatype:'jsonp',
                    crossDomain: true,
                    success: function (callback) {
                        var n = 5;
                        var tm = setInterval(countDown, 1000);

                        function countDown() {
                            n--;
                            $('#counter').html(n);
                            if (n == 0) {
                                clearInterval(tm);
                            }
                        }

                        setTimeout(redirect, 5000);
                        function redirect() {
                            window.location.href = 'https://preprod.uvbypp.cc/bookings/account/history';
                        }
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        var n = 5;
                        var tm = setInterval(countDown, 1000);

                        function countDown() {
                            n--;
                            $('#counter').html(n);
                            if (n == 0) {
                                clearInterval(tm);
                            }
                        }

                        setTimeout(redirect, 5000);
                        function redirect() {
                            window.location.href = 'https://preprod.uvbypp.cc/bookings/account/history';
                        }
                    }
                });
            }
        });
    </script>
@endsection