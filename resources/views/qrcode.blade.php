@extends("template")
@section("contenu")
    <section>
        <div class="container" id="container">
            <div class="bg-custom">
                <div class="row">
                    <div class="col-md-6 col-xs-12 text-center-md text-center-xs">
                        @if(!empty($url2))
                            <img src="http://paysdk.weixin.qq.com/example/qrcode.php?data=@php echo urlencode($url2); @endphp"
                                 class="img-thumbnail qrcod" width="304" height="236">
                        @endif
                        <img src="{{url('/')}}/public/img/communicate.png" class="img-thumbnail communicate"
                             width="304" height="236">
                    </div>


                    <div class="col-md-6 col-xs-12 text-center-md text-center-xs">
                        <img src="{{url('/')}}/public/img/phone.png" class="img-thumbnail" width="400" height="236">
                    </div>
                </div>

                <div class="col-md-6">
                    <!--                <a href="#"> < Return</a>-->
                </div>
            </div>
        </div>
    </section>
@endsection
@section("script")
    <script type="text/javascript">
                @if(!empty($nombreActuelle))
        var nombre = parseInt({{$nombreActuelle}});
                @else
        var nombre = parseInt(0);
        @endif
setInterval(checkNumber, 1000);
        function checkNumber() {
            $.ajax({
                    url: '{{url('/getNombre')}}',
                    type: 'GET',
                    success: function (data) {
                        var newNomber = parseInt(data);
                        if (nombre < newNomber) {
                            var booking_id;
                            var booking_id_session = {{\Illuminate\Support\Facades\Session::get('booking_id')}};
                            var success;
                            $.ajax({
                                url: '{{url('/getStatus')}}',
                                type: 'GET',
                                success: function (dataBooking) {
                                    booking_id = dataBooking.split('|')[0];
                                    success = dataBooking.split('|')[1];
                                    if (booking_id == booking_id_session) {
                                        if (success == 'SUCCESS') {
                                            console.log('redirecting suceess');
                                            window.location.href = '{{url('/payments/success')}}'
                                        } else {
                                            console.log('redirecting error');
                                            window.location.href = '{{url('/payments/failed')}}'
                                        }
                                    }
                                }
                            });
                        }
                    }
                }
            );
        }
    </script>
@endsection