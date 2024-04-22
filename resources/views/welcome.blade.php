<x-home-layout>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="home.css">
    @php
        $links = [
            [
                'name' => 'Inicio',
                'route' => route('home'),
                'active' => request()->routeIs('home'),
            ],
            [
                'name' => 'Acceso',
                'route' => route('dashboard'),
                'active' => request()->routeIs('about'),
            ],
        ];
    @endphp
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto:300');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif !important;
        }

        section {
            width: 100%;
            box-sizing: border-box;
        }

        .card {
            position: relative;
            max-width: 300px;
            height: auto;
            background: linear-gradient(-45deg, #fe0847, #feae3f);
            border-radius: 15px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            -ms-border-radius: 15px;
            -o-border-radius: 15px;
            margin: 0 auto;
            padding: 40px 20px;
            transition: .5s;
            -webkit-transition: .5s;
            -moz-transition: .5s;
            -ms-transition: .5s;
            -o-transition: .5s;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.1);
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
        }

        .col-sm-6:nth-child(1) .card,
        .col-sm-6:nth-child(1) .card .title .fa {
            background: linear-gradient(-45deg, #f403d1, #9a4eff);
        }

        .col-sm-6:nth-child(2) .card,
        .col-sm-6:nth-child(2) .card .title .fa {
            background: linear-gradient(-45deg, #ffec61, #f321d7);
        }

        .col-sm-6:nth-child(3) .card,
        .col-sm-6:nth-child(3) .card .title .fa {
            background: linear-gradient(-45deg, #24ff72, #9a4eff);
        }

        .card:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 40%;
            z-index: 1;
            transform: skewY(-5deg) scale(1.5);
            -webkit-transform: skewY(-5deg) scale(1.5);
            -moz-transform: skewY(-5deg) scale(1.5);
            -ms-transform: skewY(-5deg) scale(1.5);
            -o-transform: skewY(-5deg) scale(1.5);
        }

        .title .fa {
            color: #fff;
            font-size: 60px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            text-align: center;
            line-height: 100px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, .2);
        }

        .title h2 {
            position: relative;
            margin: 20px 0 0;
            padding: 0;
            color: #fff;
            font-size: 28px;
            z-index: 2;
        }

        .price {
            position: relative;
            z-index: 2;
        }

        .price h4 {
            margin: 0;
            padding: 20px 0;
            color: #fff;
            font-size: 60px;
        }

        .option {
            position: relative;
            z-index: 2;
        }

        .option ul {
            margin: 0;
            padding: 0;
        }

        .option ul li {
            margin: 0 0 10px;
            padding: 0;
            list-style: none;
            color: #fff;
            font-size: 16px;
        }

        .card a {
            position: relative;
            z-index: 2;
            background: #fff;
            width: 150px;
            height: 40px;
            line-height: 40px;
            border-radius: 40px;
            display: block;
            text-align: center;
            margin: 20px auto 0;
            -webkit-border-radius: 40px;
            -moz-border-radius: 40px;
            -ms-border-radius: 40px;
            -o-border-radius: 40px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

        .card a:hover {
            text-decoration: none;
        }

        .floatWapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 20px;
            right: 20px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-floatWapp {
            margin-top: 16px;
        }

        .telefono {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 300px;
            margin: 20px auto;
        }

        .telefono a {
            text-decoration: none;
            color: #000;
        }

        .telefono li {
            float: left;
            border: 2px solid #59cb40;
            padding: 10px;
        }

        .telefono span {
            background: #59cb40;
            padding: 12px;
            margin-left: -12px;
            color: #fff;
        }

        body {
            font: normal 10pt Helvetica, Arial;
        }

        #map {
            height: 500px;
            border: 0px;
        }
    </style>
    <!---------------- Java Scripts for Map  ----------------->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAYWHoI7YpznDze_nChj5PyRxEhh4fdI9Y&sensor=false"
        type="text/javascript"></script>



    <body style="margin: 0px; padding: 0px;" class="col-md-12 bg-secondary">
        <span class="preheader"
            style="display: none !important; visibility: hidden; opacity: 0; color: #F8F8F8; height: 0; width: 0; font-size: 1px;">Вы
            приглашены на встречу совета молодых
            педагогов&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌&nbsp;‌</span>
        <!--[if !mso]><!-->
        <div style="font-size:0px;color:transparent;opacity:0;">
            ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
        </div>
        <!--<![endif]-->
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-size: 1px; line-height: 16px;">
            <tr em="group">
                <td align="center" bgcolor="#fff"
                    style="padding: 40px 0px; background-color: #930a0a; background-size: cover; background-repeat: no-repeat;"
                    class="em-mob-padding_top-10 em-mob-padding_right-10 em-mob-padding_bottom-10 em-mob-padding_left-10"
                    background="https://img.us12.besteml.com/en/v5/user-files?userId=6573317&resource=himg&disposition=inline&name=6rp4ab11cyqewjeacmkssb739swyyq9uir6xn1i4grnh6yiif831jzhg4jyqekeru5uerwo4a86o9zfbqc5yy3ysk4jgxt17o91hquu9e8xko1epejqpo5bk8b6xuk1inyw85fwo99jxbg3utbwmhseqn1c">
                    <!--[if (gte mso 9)|(IE)]>
                    <table cellpadding="0" cellspacing="0" border="0" width="660"><tr><td>
                    <![endif]-->
                    <table cellpadding="0" cellspacing="0" width="100%" border="0"
                        style="max-width: 660px; min-width: 660px; width: 660px;" class="em-narrow-table">

                        {{-- INICIO ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%" em="atom">
                                    <tr>
                                        <td height="20">

                                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                <a class="navbar-brand" href="#"><img
                                                        src="https://facturito.ec/wp-content/uploads/2022/10/facturitoop5.png"
                                                        width="140" alt=""> </a>
                                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                                    data-target="#navbarText" aria-controls="navbarText"
                                                    aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>
                                                </button>
                                                <div class="collapse navbar-collapse" id="navbarText">

                                                    <ul class="navbar-nav mr-auto">
                                                        @foreach ($links as $link)
                                                            <li class="nav-item {{ $link['active'] ? 'active' : '' }}">
                                                                <a class="nav-link" href="{{ $link['route'] }}">
                                                                    <h6>{{ $link['name'] }}</h6>
                                                                    @if ($link['active'])
                                                                        <span class="sr-only">(current)</span>
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                    <span class="navbar-text">
                                                        <h6><b>Facturación y más</b></h6>
                                                    </span>
                                                </div>
                                            </nav>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- FIN ESPACIO --}}

                        <tr em="block" class="em-structure">
                            <td align="center"
                                style="padding: 10px 40px 1px; background-repeat: repeat; border-radius: 24px; background-size: cover;"
                                class="em-mob-padding_top-20 em-mob-padding_right-20 em-mob-padding_bottom-20 em-mob-padding_left-20"
                                background="https://img.us12.besteml.com/en/v5/user-files?userId=6573317&resource=himg&disposition=inline&name=64fgp6h47oszcieacmkssb739swyyq9uir6xn1i4grnh6yiif831jzhg4jyqekeru8fgjs8oycr9nf3nkuj8xe3osw8kftbrcj3k4bxxf87ce46hc6njk9up37wuz5sdyg3br9na3x54cn74h68ehjbjyxr">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td>
                                                        <a href="javascrip:void()" target="_blank">
                                                            <img src="https://facturito.ec/wp-content/uploads/2022/09/facturitoop4.png"
                                                                width="150" border="0" alt=""
                                                                style="display: block; width: 100%; max-width: 120px; padding-bottom: 100px">
                                                            2024
                                                        </a>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 179px;">
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" em="atom">
                                                <tr>
                                                    <td
                                                        style="padding-right: 0px; padding-bottom: 5px; padding-left: 0px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 50px; line-height: 60px; color: #ffffff;"
                                                            class="em-mob-font_size-45px em-font-Rubik-Black">
                                                            {{ date('Y') }}

                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- INICIO ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- FIN ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center" style="padding: 30px 40px 7px 39px; border-radius: 24px;"
                                bgcolor="#FFFFFF"
                                class="em-mob-padding_top-20 em-mob-padding_right-20 em-mob-padding_bottom-20 em-mob-padding_left-20">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td
                                                        style="padding-right: 0px; padding-bottom: 10px; padding-left: 0px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; line-height: 32px; color: #333333; font-size: 20px;"
                                                            class="em-mob-font_size-20px em-mob-line_height-28px em-font-Rubik-Bold row">
                                                            Servicios Disponibles
                                                            <br>
                                                        </div>
                                                        <br>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 10px;">

                                                        <div class="container-fluid">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="card text-center">
                                                                            <div class="title">
                                                                                <i class="fa fa-file-text"
                                                                                    aria-hidden="true"></i>
                                                                                <h2>Facturación Electrónica Web</h2>
                                                                            </div>
                                                                            <div class="price">
                                                                                <h4><sup>S/</sup>49</h4>
                                                                            </div>
                                                                            <div class="option">
                                                                                <ul>
                                                                                    <li><i class="fa fa-check text-white"
                                                                                            aria-hidden="true"></i>
                                                                                        Facturas
                                                                                        ilimitadas</li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Boletas ilimitadas
                                                                                    </li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Guía de remisión
                                                                                        ilimitadas</li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Creación de
                                                                                        certificado digital tributario.
                                                                                    </li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Creación de
                                                                                        credenciales para guía de
                                                                                        remision.</li>
                                                                                </ul>
                                                                            </div>
                                                                            <a href="#" data-toggle="modal"
                                                                                data-target="#exampleModal">Solicitar</a>

                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <br>

                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="card text-center">
                                                                            <div class="title">
                                                                                <i class="fa fa-eye"
                                                                                    aria-hidden="true"></i>
                                                                                <h2>Sistema Web para Optica </h2>
                                                                            </div>
                                                                            <div class="price">
                                                                                <h4><sup>S/</sup>89</h4>
                                                                            </div>
                                                                            <div class="option">
                                                                                <ul>

                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Control de Pacientes
                                                                                    </li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Control de Citas
                                                                                        Electrónicas</li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Recetas Electrónicas
                                                                                    </li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Control de ventas
                                                                                    </li>

                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Correo Corporativo
                                                                                        para envíos
                                                                                    </li>
                                                                                    <li><i class="fa fa-check"
                                                                                            aria-hidden="true"></i>
                                                                                        Reportes mensuales
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                            <a href="#" data-toggle="modal"
                                                                                data-target="#exampleModal">Solicitar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td align="center" valign="top" class="em-mob-wrap em-mob-width-100perc"
                                            style="border-radius: 10px; padding: 10px 0px;">
                                            <table width="93%" border="0" cellspacing="0" cellpadding="0"
                                                class="em-mob-width-91perc">
                                                <tr>
                                                    <td align="left">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr></tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap em-mob-height-20px">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{-- INICIO ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- FIN ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center" class="em-mob-padding_left-20 em-mob-padding_right-20">
                                <table align="center" border="0" cellspacing="0" cellpadding="0"
                                    class="em-mob-width-100perc">
                                    <tr>
                                        <td width="660" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td>
                                                        <img src="https://img.us12.besteml.com/en/v5/user-files?userId=6573317&resource=himg&disposition=inline&name=61jfnpzwmkpdypeacmkssb739swyyq9uir6xn1i4grnh6yiif831jzhg4jyqekeruso1r8s9r7rdm1jhb7ekz1eeew8cwbfgbubxu5cwh5a7rp59asxhmix8xhgwcwpmxnj5d748u8d48mns687ym64oiqc"
                                                            width="660" border="0" alt=""
                                                            style="display: block; width: 100%; max-width: 660px; border-top-left-radius: 24px; border-top-right-radius: 24px;">
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center"
                                class="em-mob-padding_top-20 em-mob-padding_right-20 em-mob-padding_bottom-20 em-mob-padding_left-20"
                                style="padding-top: 24px; padding-right: 39px; padding-left: 40px; background-color: #ffffff; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px;"
                                bgcolor="#FFFFFF">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td class="em-mob-wrap em-mob-width-100perc" width="621" valign="top">



                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td
                                                        style="padding-right: 0px; padding-bottom: 10px; padding-left: 0px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; line-height: 32px; color: #333333; font-size: 20px;"
                                                            class="em-mob-font_size-20px em-mob-line_height-28px em-font-Rubik-Bold">
                                                            Solicita una llamada directa y te contactamos al instante
                                                            por un asesor</div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td align="left">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="25%" style="width: 25%;">
                                                            <tr>
                                                                <td align="center" valign="middle" height="41"
                                                                    style="background-color: #1c52dc; height: 41px; border-radius: 24px;">
                                                                    <a data-toggle="modal" data-target="#exampleModal"
                                                                        href="javascript:void()"
                                                                        style="display: block; height: 41px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px; line-height: 41px; text-decoration: none; white-space: nowrap;"
                                                                        class="em-font-Rubik-Bold"><strong
                                                                            style="font-weight: 600;">
                                                                            Solicitar
                                                                        </strong></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td align="center" valign="top" class="em-mob-wrap em-mob-width-100perc"
                                            style="border-radius: 10px; padding: 10px 0px;" width="NaN">
                                            <table width="93%" border="0" cellspacing="0" cellpadding="0"
                                                class="em-mob-width-91perc">
                                                <tr>
                                                    <td align="left">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr></tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap em-mob-height-20px">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{-- INICIO ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- FIN ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center"
                                style="padding: 0px 40px; border-top-left-radius: 24px; border-top-right-radius: 24px;"
                                bgcolor="#FFFFFF" class="em-mob-padding_left-20 em-mob-padding_right-20">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding: 20px 0 10px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 20px; line-height: 38px; color: #333333;"
                                                            class="em-font-Rubik-Bold">Verificaciones y Recolección de
                                                            Datos </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr em="block" class="em-structure">
                            <td align="center"
                                style="padding-right: 40px; padding-bottom: 7px; padding-left: 40px; border-bottom-right-radius: 24px; border-bottom-left-radius: 24px;"
                                bgcolor="#FFFFFF" class="em-mob-padding_left-20 em-mob-padding_right-20">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table align="center" cellpadding="0" cellspacing="0" border="0"
                                                width="100%">
                                                <tr em="atom">
                                                    <td width="36" valign="top">
                                                        <table width="26" border="0" cellspacing="0"
                                                            cellpadding="0">
                                                            <tr>
                                                                <td align="center" height="26" bgcolor="#1C52DC"
                                                                    style="height: 26px; border-radius: 50px;">
                                                                    <div
                                                                        style="font-family: -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 16px; color: #FFFFFF;">
                                                                        1</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="left" valign="top">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr>
                                                                <td style="padding-bottom: 5px;">
                                                                    <div
                                                                        style="font-family: -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 21px; color: #333333;">
                                                                        <strong>
                                                                            Somos una empresa verificada por <img
                                                                                src="https://proludica.com/wp-content/uploads/2019/10/SUNAT.png"
                                                                                width="80" alt="">
                                                                        </strong>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr>
                                                                <td style="padding-bottom: 15px;">
                                                                    <font color="#5a5a5a"
                                                                        face="-apple-system, Segoe UI, Helvetica Neue, Helvetica, Roboto, Arial, sans-serif"
                                                                        size="3"><span
                                                                            style="caret-color: #5a5a5a;">
                                                                            Con el sólido resguardo de SUNAT Perú
                                                                        </span>
                                                                    </font><br>
                                                                    <hr>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr em="atom">
                                                    <td width="36" valign="top">
                                                        <table width="26" border="0" cellspacing="0"
                                                            cellpadding="0">
                                                            <tr>
                                                                <td align="center" height="26" bgcolor="#1C52DC"
                                                                    style="height: 26px; border-radius: 50px;">
                                                                    <div
                                                                        style="font-family: -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 16px; color: #FFFFFF;">
                                                                        2</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td align="left" valign="top">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr>
                                                                <td style="padding-bottom: 5px;">
                                                                    <div
                                                                        style="font-family: -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 16px; line-height: 21px; color: #333333;">
                                                                        <strong>
                                                                            Fidelidad de Datos otorgados de <img
                                                                                src="https://plateccs.com.pe/wp-content/uploads/reniec-logo.png"
                                                                                width="105" alt="">
                                                                        </strong>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr>
                                                                <td style="padding-bottom: 15px;">
                                                                    <font color="#5a5a5a"
                                                                        face="-apple-system, Segoe UI, Helvetica Neue, Helvetica, Roboto, Arial, sans-serif"
                                                                        size="3"><span
                                                                            style="caret-color: #5a5a5a;">
                                                                            Integridad de datos de con la garantía de
                                                                            RENIEC PERÚ
                                                                        </span></font><br>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>

                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- INICIO ESPACIO --}}
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {{-- FIN ESPACIO --}}

                        <tr em="block" class="em-structure">
                            <td align="center" style="padding: 20px 40px 10px; border-radius: 24px;"
                                bgcolor="#FFFFFF" class="em-mob-padding_left-20 em-mob-padding_right-20">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 20px;">
                                                        <div class="em-mob-font_size-26px em-mob-line_height-32px em-font-Rubik-Bold"
                                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 20px; line-height: 48px; color: #333333;">
                                                            Beneficios de Facturito</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="180" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <img src="https://img.us12.besteml.com/en/v5/user-files?userId=6573317&resource=himg&disposition=inline&name=64z3ek39dnxxe5eacmkssb739swyyq9uir6xn1i4grnh6yiif831jzhg4jyqekeru4en6ef999iyrs5xc1ez31gjkr3c5yqtuexcp8zrmnx9611f9ufdzmwb6xwyx57m5z9hk4m8466ktwe9k5bjphpuupo"
                                                            width="35" border="0" alt=""
                                                            style="display: inline-block;">
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 5px;">
                                                        <div style="line-height: 21px; font-family: Helvetica, Arial, sans-serif; font-size: 16px;"
                                                            class="em-font-Rubik-Bold"><b>Ahorros y mas <span
                                                                    style="caret-color: #333333;">Ganancias</span></b>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 20px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 21px; color: #5a5a5a;"
                                                            class="em-font-Rubik-Regular">
                                                            Un software completo, que facilita la gestion de tu empresa.
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap">&nbsp;</td>
                                        <td width="180" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <img src="https://img.us12.besteml.com/en/v5/user-files?userId=6573317&resource=himg&disposition=inline&name=6bmxhh9b1wphwpeacmkssb739swyyq9uir6xn1i4grnh6yiif831jzhg4jyqekerukfqsrafeyf1ptm3uzs9mykdgbfq9rkyjdteu1msd1zpjzaw5y9nhwkwkarmr73bqz9hk4m8466ktwgbx3o3u11wd1w"
                                                            width="35" border="0" alt=""
                                                            style="display: inline-block; max-width: 35px;">
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 5px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 21px; color: #333333;"
                                                            class="em-font-Rubik-Bold"> <strong>
                                                                Crecimiento exponencial
                                                            </strong></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 20px;">
                                                        <font color="#5a5a5a"
                                                            face="-apple-system, Segoe UI, Helvetica Neue, Helvetica, Roboto, Arial, sans-serif"
                                                            size="3"><span style="caret-color: #5a5a5a;"><span
                                                                    style="font-family: Helvetica, Arial, sans-serif;"
                                                                    class="em-font-Rubik-Regular">
                                                                    Al tener facturito tendrás el poder de manejar a tus
                                                                    clientes en forma masiva.
                                                                </span></span></font><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap">&nbsp;</td>
                                        <td width="180" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <img src="https://emcdn.ru/1865/230829_18_wG5ABxt.png"
                                                            width="35" border="0" alt=""
                                                            style="display: inline-block;">
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 5px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 21px; color: #333333;"
                                                            class="em-font-Rubik-Bold">
                                                            Serás el Preferido de la competencia
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 20px;">
                                                        <font color="#5a5a5a" face="Rubik, sans-serif"
                                                            size="3"><span style="caret-color: #5a5a5a;">
                                                                Nuestros software mantienen un perfil destacado al nivel
                                                                de gestión y de estética.</span></font><br>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center" style="padding: 30px 40px 7px 39px; border-radius: 24px;"
                                bgcolor="#FFFFFF"
                                class="em-mob-padding_top-20 em-mob-padding_right-20 em-mob-padding_bottom-20 em-mob-padding_left-20">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="top" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td
                                                        style="padding-right: 0px; padding-bottom: 10px; padding-left: 0px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; line-height: 32px; color: #333333; font-size: 20px;"
                                                            class="em-mob-font_size-20px em-mob-line_height-28px em-font-Rubik-Bold">
                                                            Visítanos </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 21px; color: #222222;"
                                                            class="em-mob-line_height-18px em-font-Rubik-Regular">
                                                            Nos ubicamos en Nuevo Chimbote, Región de Ancash<br>
                                                            Horario de atención: <br>
                                                            <strong>De: </strong> Lunes a Sábado
                                                            <br>
                                                            <strong>De: </strong> 08:00-18:30<br>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td>
                                                        <div class="col-md-12">
                                                            <a href="https://maps.app.goo.gl/Mwehar8V1oVH65SC9"
                                                                target="_blank">
                                                                <img width="300" height="300"
                                                                    src="https://maps.googleapis.com/maps/api/staticmap?center=-9.122424,-78.522164&zoom=13&size=900x600&key=AIzaSyBfZGs4MOM0s5Gty1z88S-KcZFYDDcDVic&markers=color:red%7Clabel:Facturito%7C-9.122424,-78.522164"
                                                                    alt="">

                                                            </a>
                                                        </div>


                                                    </td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td align="center" valign="top" class="em-mob-wrap em-mob-width-100perc"
                                            style="border-radius: 10px; padding: 10px 0px;">
                                            <table width="93%" border="0" cellspacing="0" cellpadding="0"
                                                class="em-mob-width-91perc">
                                                <tr>
                                                    <td align="left">
                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr></tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap em-mob-height-20px">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center">

                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                    em="atom">
                                    <tr>
                                        <td height="20"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr em="block" class="em-structure">
                            <td align="center"
                                style="padding: 30px 40px 31px; background-color: #ffffff; background-repeat: repeat; border-radius: 24px;"
                                class="em-mob-padding_top-20 em-mob-padding_right-20 em-mob-padding_bottom-20 em-mob-padding_left-20"
                                bgcolor="#fff">
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="280" valign="top"
                                            class="em-mob-wrap em-mob-wrap-cancel em-mob-width-auto">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td>
                                                        <a href="https://sch2009uz.mskobr.ru" target="_blank"><img
                                                                src="https://facturito.ec/wp-content/uploads/2022/10/facturitoop5.png"
                                                                width="138" border="0" alt=""
                                                                style="display: block; width: 100%; max-width: 138px;"></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="20" class="em-mob-wrap em-mob-wrap-cancel">&nbsp;</td>
                                        <td width="280" valign="top"
                                            class="em-mob-wrap em-mob-wrap-cancel em-mob-width-auto">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-bottom: 20px;" align="right">
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="40">
                                                                    <a href="https://vk.com/school2009official"
                                                                        target="_blank"><img
                                                                            src="https://freepnglogo.com/images/all_img/1697562496facebook-logo-png.png"
                                                                            width="30" border="0"
                                                                            alt=""
                                                                            style="display: block; max-width: 30px;"></a>
                                                                </td>
                                                                <td width="35">
                                                                    <a href="https://ok.ru/group/70000001499882"
                                                                        target="_blank"><img
                                                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/1200px-Instagram_logo_2022.svg.png"
                                                                            width="30" border="0"
                                                                            alt=""
                                                                            style="display: block;"></a>
                                                                </td>
                                                                <td width="40">
                                                                    <a href="https://t.me/school2009official"
                                                                        target="_blank"><img
                                                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/2044px-WhatsApp.svg.png"
                                                                            width="40" border="0"
                                                                            alt=""
                                                                            style="display: block;"></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellspacing="0" cellpadding="0" class="em-mob-width-100perc">
                                    <tr>
                                        <td width="580" valign="middle" class="em-mob-wrap em-mob-width-100perc">
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td style="padding-top: 20px; padding-bottom: 10px; border-top: 1px solid #EEEEEE"
                                                        align="center" class="em-mob-padding_bottom-15">
                                                        <div style="font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 18px; color: #a3adbb;"
                                                            class="em-mob-font_size-14px em-mob-line_height-18px em-font-Rubik-Regular"
                                                            align="left">
                                                            Somos la empresa de facturación electrónica líder del Perú.
                                                            Autorizada para funcionar
                                                            como empresa facturación electrónica o entidad extendida de
                                                            la administración de impuestos.
                                                            Contamos con experiencia a nivel global, trabajando con la
                                                            estandarización de facturas electrónicas.
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" border="0" width="100%"
                                                em="atom">
                                                <tr>
                                                    <td height="2"></td>
                                                </tr>
                                            </table>

                                            <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                <tr>
                                                    <td>

                                                        <table cellpadding="0" cellspacing="0" border="0"
                                                            width="100%" em="atom">
                                                            <tr>
                                                                <td class="em-mob-padding_bottom-10">
                                                                    <div
                                                                        style="font-family: -apple-system, 'Segoe UI', 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 21px; color: #9299a2;">
                                                                        ©&nbsp;{{ date('Y') }}</div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--[if (gte mso 9)|(IE)]>
                    </td></tr></table>
                    <![endif]-->
                    <a href="https://wa.me/+51902517849?text=Hola, quisiera adquirir el servicio..." class="floatWapp"
                        target="_blank">
                        <i class="fa fa-whatsapp my-floatWapp"></i>
                    </a>


                </td>
            </tr>
        </table>
    </body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

                <!--Header-->
                <div class="modal-header">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%281%29.jpg"
                        class="rounded-circle img-responsive" alt="Avator photo">
                </div>
                <!--Body-->
                <div class="modal-body text-center mb-1">


                    <div class="text-center" style="margin-left: 20px">

                        <b>RAUL BACA - SOPORTE TECNICO</b>
                        <ul class="telefono text-center mr-2">
                            <li><a href="https://wa.me/+51902517849?text=Hola, quisiera adquirir el servicio..."
                                    target="_blank"><span><i class="fa fa-whatsapp"></i> WHATSAPP</span> + 51
                                    902517849 </a></li>
                        </ul>
                        <br>
                        <br>
                    </div>
                    <div class="text-center" style="margin-left: 20px">
                        <br>
                        <br>
                        <b>PERLA GARCIA - CALL CENTER</b>
                        <ul class="telefono text-center mr-2">
                            <li><a href="https://wa.me/+51900407353?text=Hola, quisiera adquirir el servicio..."
                                    target="_blank"><span><i class="fa fa-whatsapp"></i> WHATSAPP</span> + 51
                                    900407353 </a></li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>

</x-home-layout>
