<x-home-layout>

    <!-- welcome section -->
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

        .col-sm-4:nth-child(1) .card,
        .col-sm-4:nth-child(1) .card .title .fa {
            background: linear-gradient(-45deg, #f403d1, #64b5f6);
        }

        .col-sm-4:nth-child(2) .card,
        .col-sm-4:nth-child(2) .card .title .fa {
            background: linear-gradient(-45deg, #ffec61, #f321d7);
        }

        .col-sm-4:nth-child(3) .card,
        .col-sm-4:nth-child(3) .card .title .fa {
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
    </style>

    <section class="welcome_section layout_padding">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    Facturito Servicios

                </h2>
            </div>



            <body>
                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <link rel="stylesheet" type="text/css" href="home.css">
                <br>
                <section>
                    <div class="container-fluid">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <div class="title">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            <h2>Facturación Electrónica Web</h2>
                                        </div>
                                        <div class="price">
                                            <h4><sup>S/</sup>99</h4>
                                        </div>
                                        <div class="option">
                                            <ul>
                                                <li><i class="fa fa-check text-white" aria-hidden="true"></i> Facturas
                                                    ilimitadas</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Boletas ilimitadas
                                                </li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Guía de remisión
                                                    ilimitadas</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Creación de
                                                    certificado digital tributario.</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Creación de
                                                    credenciales para guía de remision.</li>
                                            </ul>
                                        </div>
                                        <a href="#">Solicitar</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <div class="title">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <h2>Sistema para Optica Web</h2>
                                        </div>
                                        <div class="price">
                                            <h4><sup>S/</sup>99</h4>
                                        </div>
                                        <div class="option">
                                            <ul>

                                                <li><i class="fa fa-check" aria-hidden="true"></i> Control de Pacientes
                                                </li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Control de Citas
                                                    Electrónicas</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Recetas Electrónicas
                                                </li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Control de ventas
                                                </li>

                                                <li><i class="fa fa-check" aria-hidden="true"></i> Correo Corporativo
                                                    para envíos
                                                </li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Reportes mensuales
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="#">Solicitar</a>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <div class="title">
                                            <i class="fa fa-rocket" aria-hidden="true"></i>
                                            <h2>Pack: <br> Fact. Electrónica Web <b>+</b> Sistema de Óptica Web</h2>
                                        </div>
                                        <div class="price">
                                            <h4><sup>S/</sup>149</h4>
                                        </div>
                                        <div class="option">
                                            <ul>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Facturación
                                                    Electrónica</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Sistema de gestión de
                                                    óptica</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Soporte para
                                                    actualizaciones</li>
                                                <li><i class="fa fa-check" aria-hidden="true"></i> Usuarios Ilimitados
                                                    (Óptica)</li>
                                            </ul>
                                        </div>
                                        <a href="#">Solicitar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </body>
        </div>
    </section>

    <section class="welcome_section layout_padding">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    Bienvenido a Facturito
                </h2>
            </div>

            <div class="layout_padding2">
                <div class="img-box">
                    <img src="images/welcome.png" alt="" />
                </div>
                <div class="detail-box">
                    <p>
                        Aquí encontrarás soluciones de facturación electrónica y servicios contables para impulsar el
                        crecimiento de tu negocio. Nuestro equipo altamente capacitado está listo para brindarte
                        atención personalizada y tecnología de vanguardia. ¡Estamos emocionados de ser parte de tu éxito
                        empresarial!
                    </p>
                    <div>
                        <a href="">
                            Leer más
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end welcome section -->

    <!-- service section -->
    <section class="service_section">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    Nuestros servicios
                </h2>
            </div>
            <div class="service_container layout_padding2">
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/s-1.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Facturación <br />
                            Electrónica
                        </h4>
                        <p>
                            Simplifica tus procesos de facturación con nuestra solución electrónica de acuerdo con los
                            requisitos de la SUNAT.
                        </p>
                    </div>
                </div>
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/s-2.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Sistema <br />
                            Contable
                        </h4>
                        <p>
                            Gestiona eficientemente tu contabilidad con nuestro sistema integrado que automatiza tareas
                            clave y brinda informes precisos.
                        </p>
                    </div>
                </div>
                <div class="service_box">
                    <div class="img-box">
                        <img src="images/s-3.jpg" alt="" />
                    </div>
                    <div class="detail-box">
                        <h4>
                            Control de <br />
                            Inventario
                        </h4>
                        <p>
                            Optimiza tu gestión de inventario y asegura un control preciso de tus productos con nuestra
                            solución especializada.
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <a href="">
                    Leer más
                </a>
            </div>
        </div>
    </section>

    <!-- end service section -->
    <!--problem section -->
    <section class="problem_section layout_padding">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    ¿Tienes algún problema comercial?
                </h2>
            </div>
            <div class="layout_padding2">
                <div class="img-box">
                    <img src="images/problem.jpg" alt="" />
                </div>
                <div class="detail-box">
                    <p>
                        <b>
                            Estamos aquí para ayudarte. </b>
                    </p>
                    <div>
                        <a href="">
                            Leer Más
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end problem section -->

    <!-- why section -->
    <section class="why_section layout_padding">
        <div class="container">
            <div class="custom_heading-container">
                <h2>
                    Por qué elegirnos
                </h2>
            </div>
            <div class="content-container">
                <p>
                    Somos tu mejor opción. Con nuestra experiencia y compromiso, te ofrecemos soluciones confiables,
                    eficientes y personalizadas que impulsarán el éxito de tu negocio.
                </p>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="img-box">
                            <img src="images/smiley.png" alt="" />
                        </div>
                        <div class="detail-box">
                            <h6>
                                Experiencia comprobada.
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="img-box">
                            <img src="images/monitor.png" alt="" />
                        </div>
                        <div class="detail-box">
                            <h6>
                                Soluciones <br>
                                integrales.
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="img-box">
                            <img src="images/multiple-users-silhouette.png" alt="" />
                        </div>
                        <div class="detail-box">
                            <h6>
                                Confiabilidad <br>
                                garantizada.
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="img-box">
                            <img src="images/bar-chart.png" alt="" />
                        </div>
                        <div class="detail-box">
                            <h6>
                                Atención <br>
                                personalizada.
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- end why section -->

    <!-- client section -->
    <section class="client_section layout_padding">
        <div class="container">
            <h2>
                What Our Clients Says
            </h2>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="client_container layout_padding2">
                            <div class="client_text">
                                <p>
                                    psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore
                                    magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                    aliquip ex ea
                                    commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                </p>
                            </div>
                            <div class="detail-box">
                                <div class="img-box">
                                    <img src="images/client.png" alt="" />
                                </div>
                                <div class="name">
                                    <h5>
                                        Joans Mark
                                    </h5>
                                    <p>
                                        cal
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="client_container layout_padding2">
                            <div class="client_text">
                                <p>
                                    psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore
                                    magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                    aliquip ex ea
                                    commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                </p>
                            </div>
                            <div class="detail-box">
                                <div class="img-box">
                                    <img src="images/client.png" alt="" />
                                </div>
                                <div class="name">
                                    <h5>
                                        Joans Mark
                                    </h5>
                                    <p>
                                        cal
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="client_container layout_padding2">
                            <div class="client_text">
                                <p>
                                    psum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore
                                    magna
                                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                    aliquip ex ea
                                    commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                </p>
                            </div>
                            <div class="detail-box">
                                <div class="img-box">
                                    <img src="images/client.png" alt="" />
                                </div>
                                <div class="name">
                                    <h5>
                                        Joans Mark
                                    </h5>
                                    <p>
                                        cal
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </section>
    <!-- end client section -->

    <!-- contact section -->
    <section class="contact_section layout_padding">
        <div class="container contact_heading">
            <h2>
                Contacta con nosotros.
            </h2>
            <p>
                ¡Contáctanos hoy mismo y descubre cómo podemos ayudarte a impulsar tu negocio!
            </p>
        </div>
        <div class="container">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputName4">Name</label>
                        <input type="text" class="form-control" id="inputName4" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" />
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNumber4">Phone number</label>
                        <input type="tel" class="form-control" id="inputNumber4" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">Select Service</label>
                        <select id="inputState" class="form-control">
                            <option selected=""></option>
                            <option>...</option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputMessage">Message</label>
                    <input type="text" class="form-control" id="inputMessage" placeholder="" />
                </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="">Send</button>
        </div>
        </form>

    </section>


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


    <a href="https://wa.me/+51902517849?text=Hola, quisiera adquirir el servicio..." class="floatWapp"
        target="_blank">
        <i class="fa fa-whatsapp my-floatWapp"></i>
    </a>


</x-home-layout>
