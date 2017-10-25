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
            url: '{{url('/getPayement')}}',
            type: 'GET',
            data: 'booking={{\Illuminate\Support\Facades\Session::get('booking_id')}}',
            success: function (data) {
                var amount = data.split('|')[0];
                var transaction = data.split('|')[1];
                var date = data.split('|')[2];
                $.ajax({
                    url: 'https://uvbypp.cc/bkk/adminv2/index.php/wechat/callback',
                    type: 'POST',
                    data: 'booking={{\Illuminate\Support\Facades\Session::get('booking_id')}}&status=PAID&amount=' + amount + '&date=' + date + '&transaction=' + transaction,
					crossDomain: true,
					dataType: 'jsonp',
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
                            window.location.href = 'http://uvbypp.cc/bookings/account/history';
                        }
                    }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }, beforeSend: setHeader
                });
            }
        });
    </script>
@endsection