<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Payments</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

           /* body{
                background-image: url(http://www.hdwallpapers.in/walls/interstellar_voyage-wide.jpg);
                height: 100vh;
                background-size: cover;
                margin-bottom: 50px;

                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

                text-align: center;
            }*/

            p{
                max-width: 600px;
                margin: 0 auto 20px;
            }

            h1{
                color: rgba(0, 0, 0, 0.5);
                -webkit-text-stroke: 1.4px grey;
            }

            h4{
                color: grey;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <!--<h1>Welcome!</h1><h4>ULTRAVIOLET and MMBUND Payments</h4><h4>It's nice to see you again</h4>-->
				<h1>欢迎到</h1>
				<h1>保保餐饮有限公司</h1>
				<h1>支付宝服务器</h1>				
            </div>
        </div>
        {{--<header><h1>Welcome!</h1><h4>It's nice to see you again</h4></header>--}}
    </body>
	<footer>
		<div class="content">
			<p>沪ICP备16038688号-</p>
		</div>
	</footer>
</html>
