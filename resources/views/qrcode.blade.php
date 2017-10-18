<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('/')}}/public/css/mediaqueries.css">
    <link rel="stylesheet" href="{{url('/')}}/public/css/animate.css">
    <link rel="stylesheet" href="{{url('/')}}/public/css/font-awesome.css">
    <link href="{{url('/')}}/public/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{url('/')}}/public/js/jquery.min.js"></script>
    <script src="{{url('/')}}/public/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{url('/')}}/public/css/style.css">
    <title>微信支付样例-退款</title>
</head>
<body>
<header>
    <nav id="background" class="navbar navbar-default navbar-static-top ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="{{url('/')}}/public/img/alipay.png">
                </a>

                <a class="navbar-brand" href="#">
                    <img src="{{url('/')}}/public/img/wechat.png">
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <!--<ul class="nav navbar-nav navbar-right ">
                    <li><a href="#">USERNAME</a></li>
                    <li><a href="#">LOGOUT</a></li>
                </ul>-->
            </div>
        </div>
    </nav>
</header>
<section>
    <div class="container">
        <div class="row information">
            <div class="col-md-6 col-xs-12">
                <p class="text-left-xs text-left-sm text-right-md"><label>Order number :</label> {{\Illuminate\Support\Facades\Session::get('booking_id')}}</p>
            </div>
            <div class="col-md-6 col-xs-12 ">
                <p class="text-left-xs text-left-sm text-right-md"><label>Total Price
                        : </label> {{\Illuminate\Support\Facades\Session::get('amount')}}
                <p>
            </div>
        </div>
        <hr class="separate">
    </div>
</section>
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

<footer id="footer">
    <div class="container">
        <hr class="divider">
        <p class="text-center">Copyright © Ultraviolet 2017
        <p>
    </div>
</footer>
</body>
</html>