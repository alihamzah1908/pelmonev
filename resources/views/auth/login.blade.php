<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ 'Login | '.configuration('APP_NAME') }}</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://eproc.bpkh.go.id/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/iproc_scm.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css"/>

    <style>
        .form-control {
            border: 1px solid #aaa;
            border-radius: 60px;
            font-size: 12px;
            padding: 12px;
        }

        .form-control:focus {
            border: 1px solid #092f53 !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline: 0 !important;
            color: #2c2c2c !important;
        }

        .form-control:focus + .input-group-text,
        .form-control:focus ~ .input-group-text {
            border: 1px solid #092f53 !important;
            border-left: none !important;
        }

        .text-left.opening-text {
            display: block;
        }

        .text-left.opening-text {
            position: fixed;
            color: #fff;
            top: 30%;
            font: 52px 'Roboto';
            font-weight: 700;
            padding-left: 20px;
        }

        .btn:hover {
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .btn-color {
            border-radius: 60px;
            padding: 8px;
            background: #092f53;
            font-weight: 600;
            color: #fff !important;
        }

        .btn-color:hover {
            background: #092f53;
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .btn-color:focus {
            background: #092f53;
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .btn-daftar {
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 60px;
            padding: 8px;
            background: #e09346;
            font-weight: 600;
            color: #fff !important;
        }

        .btn-daftar:hover {
            background: #e09346;
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .btn-daftar:focus {
            background: #e09346;
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .loginLogin {
            position: absolute;
            right: 0;
            height: 93%;
            margin: 2.5%;
            background: rgb(255, 255, 255, .85);
            opacity: 1;
            border-radius: 3px;
            border-left: 0px;
            padding: 15px 20px 20px 15px;
            border-color: #e7eaec;
            border-image: none;
            border-style: solid solid none;
            border-width: 1px 0px;
            box-shadow: 0px 5px 12px rgba(0, 0, 0, 0.3);
        }

        #forgot-btn,
        #back-login-btn {
            color: #267bd9;
            font-weight: 700;
        }

        #forgot-btn:hover,
        #back-login-btn:hover {
            text-decoration: underline;
        }

        .btnSpesial {
            height: 60px;
            background: rgb(255, 255, 255, .75);
            text-align: center left;
            color: #092f53;
            font-weight: 600;
            max-width: 200%;
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
        }

        .btn1:hover {
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
            color: white;
            background: #092f53;
        }

        .isiBtnSpesial {
            max-width: 80%;
            top: 40%;
            height: 100% auto;
            float: left;
            text-align: left;
        }

        .panahBtnSpesial {
            max-width: 20%;
            height: 100% auto;
            float: right;
            text-align: right;
            padding-right: 5%
        }

        body {
            font-family: 'Open Sans', serif;
        }

        .btn-default.btn-outline:hover {
            box-shadow: 0 14px 18px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
        }

        .btn-default {
            border-color: #000000;
            color: #000000;
        }

        .btn-default:hover {
            background-color: transparent;
            border-color: #000000;
            color: #000000;
        }

        .wrap {
            white-space: normal
        }

        .tmbl {
            width: 100%;
        }

        @media screen and (max-device-width: 850px) {
            .tmbl {
                width: 170% !important;
                position: relative;
                margin-top: 10px;

            }
        }

        @media screen and (max-device-width: 550px) {
            .tmbl {
                width: 200% !important;
                position: relative;
                margin-top: 10px;
            }

            .loginColumns-d {
                max-width: 26.5%;
            }
        }

        @media screen and (max-device-width: 370px) {
            .tmbl {
                width: 170% !important;
                position: relative;
                margin-top: 30px;
            }

            .loginColumns-d {
                top: 165px;
                max-width: 100%;
                left: 0;
            }
        }

        @media screen and (max-device-width: 420px) {
            .tmbl {
                width: 170% !important;
                position: relative;
                margin-top: 10px;
            }

            .isiBtnSpesial {
                text-align: left;
                font-size: 12px;
            }

            .loginColumns-d {
                top: 165px;
                max-width: 100%;
                left: 0;
            }
        }

        .vidcontainer {
            margin: 20px auto;
            max-width: 500px;
        }
    </style>
</head>

<body class="gray-bg login-bg">
<div id="azzaz" style=" position: absolute; top: 20%; left: 0; position: absolute; min-width: 25%;">

    <div class="tmbl animated bounceInDown" style="-webkit-animation-duration: 1.5s; animation-duration: 2s;">
        <iframe width="640" height="385" src="https://www.youtube.com/embed/BaIyOpprnzA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

</div>

<!--
  <div id="crPC" style="bottom: 0; position: fixed;">
    <small>&copy; <?//php $made = 2019;
//echo ($made == DATE('Y')) ? $made : $made . '-' . DATE('Y') ?> All Rights Reserved</small>
  </div> -->

<div class="loginLogin animated slideInRight loginLogin wrapper">
    <!-- <div class="ibox-content"> -->
    <div class="row" style="margin-left: 8%; margin-right: 8%; margin-bottom: 3%;">
        <div style="height: 100%;">
            <div class="align-content-center" style="text-align: center; margin-bottom: 50px;">
                    <img src="{{ url(configuration('APP_ALIAS_LOGO')) }}" class="img-responsive"
                         style="max-width:70%;" alt="logo-sim-kemas">
            </div>
            <form class="m-t" role="form" id="login_form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="font-bold" style="text-align: center;"><h2>Login SIM Kemaslahatan</h2></div>
                <div id="form_logged">
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="{{ __('User ID/Email') }}"
                               id="username_login" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="{{ __('Password') }}"
                               id="password_login" required>
                    </div>
                    <div class="form-group captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                            &#x21bb;
                        </button>

                    </div>
                    <div class="form-group row">
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                        @error('captcha')
                        <br />
                        <p class="text-danger" style="width: 100%;">
                            <strong>Invalid Captcha!</strong>
                        </p>
                        @enderror
                    </div>
                </div>

                <button id="logins" type="submit" class="btn btn-color btn1 block m-b" style="float: left;color:white">
                    Login
                </button>

                <br/>
                <div class="m-t form-group">
                    <a href="{{ url('/register') }}">
                        <button type="button" class="btn btn-daftar block m-b " style="width:100%">
                            DAFTAR
                        </button>
                    </a>
                    <a id="forgot-btn" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                </div>

            </form>

            <br>
            <p class="alert alert-info alert-rounded">
                <strong class="informasion">Informasi Kontak</strong>
                <br/>
                Telp : (021) 83793001
                <br/>
                Email : info@bpkh.go.id
            </p>
            <!-- <div style="height: 25%;text-align: center">
              <small style="margin-top: 10px;"><i>Direkomendasikan minimal menggunakan browser Chrome versi 77 atau Firefox versi 70 atau Safari versi 12</i></small>
            </div> -->
            <br/>
            <div style="text-align: center;">
                <small>&copy; 2022 All Rights Reserved</small>
            </div>
            <br/>
        </div>
    </div>
    <!-- <div class="row"> -->


</div>

</body>
<!-- Core JS files -->
<script src="/global_assets/js/main/jquery.min.js"></script>
<script src="/global_assets/js/main/bootstrap.bundle.min.js"></script>
<script src="/global_assets/js/plugins/loaders/blockui.min.js"></script>
<script src="/global_assets/js/plugins/ui/ripple.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
<script src="/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
<script src="/global_assets/js/plugins/forms/validation/validate.min.js"></script>
<script src="/global_assets/js/plugins/forms/validation/localization/messages_id.js"></script>

<script src="https://cdn.plyr.io/3.6.12/plyr.polyfilled.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '/reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });

        let width = parseInt($(window).width());
        if (width > 480) {
            $(".slideInRight").addClass("loginColumns-d");
            $("#azzaz").addClass("loginPengadaan-d");
            $('#logins').css('width', '100%');
        } else {
            $(".slideInRight").addClass("loginColumns");
            $("#azzaz").hide();
            $('#logins').css('width', '80%');
        }

        const player = new Plyr('#vidplayer', {title: 'Contoh Video',});
    });

</script>

</html>
