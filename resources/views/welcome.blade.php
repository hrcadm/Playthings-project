<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Webpack CSS -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #efefef;
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
                min-width: 450px;
                width: 50%;
                margin: 0 auto;
                border: 1px solid #bbb;
                background: white;
                box-shadow: 5px 5px 10px #ccc;
            }

            #homeLinks {
                list-style-type: none;
            }

            #homeLinks > li > a {
                text-decoration: none;
                color: #636b6f;
                margin-bottom: 10px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            #homeLinks > li > a:hover {
                text-decoration: none;
                color: green;
                font-weight: 800;
                font-size: 13px;
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
            #welcomeLogo {
                padding-top: 20px;
            }
            .icon-download {
                font-size: 26px;
                text-align: left;
                padding: 5px 0;
            }
            #downloadLinks {
                padding: 20px 0;
            }
            #mainContent {
                padding-top: 15px;
            }
            .icon-user {
                padding-right: 0.3em;
                padding-left: 0.3em;
            }
            .icon-cog2 {
                padding-right: 0.3em;
                padding-left: 0.3em;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content container">
                <div style="padding: 30px 0;text-align: center;">
                    <img src="{{ asset('assets/images/logo-epoch.png') }}" id="welcomeLogo">
                </div>
                <div class="row" id="mainContent">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <p style="font-weight:600;">
                            Welcome to International Playthings’ online C.O.C. Access System. <br><br>
                            This system has been developed in accordance with the guidelines of the U.S. Consumer Product Safety Improvement Act to give our customers instant access to Certificates of Conformity for each item that International Playthings imports and distributes. <br>
                            We are currently in the process of testing a vast quantity of products. The system is updated daily as new data becomes available.
                        </p>
                        <p style="font-weight:600;color:red;">
                            If you do not find the Certificate of Conformity that you are looking for, please check back at a later date.
                        </p>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

                <div class="row" id="downloadLinks">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <ul id="homeLinks">
                            <li>
                                <a href="{{ route('export-coc') }}"><i class="icon-download"></i>  Export Cerfiticate of Conformity</a>
                            </li>
                            <li>
                                <a href="{{ route('export-item-test-report') }}"><i class="icon-download"></i>  Export Item Safety Tests</a>
                            </li>
                            <hr>
                            <li>
                                @auth
                                    <a href="{{ route('home') }}">Admin section</a>
                                @else
                                    <a href="{{ route('login') }}">Login</a>
                                @endauth
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </div>

    {{-- WEBPACK JAVASCRIPTS --}}
    <script src="{{ asset('js/scripts.js') }}"></script>

    </body>
</html>
