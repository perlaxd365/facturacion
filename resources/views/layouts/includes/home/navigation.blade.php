@php
    $links = [
        [
            'name' => 'Home',
            'route' => route('home'),
            'active' => request()->routeIs('home'),
        ],
        [
            'name' => 'Nosotros',
            'route' => route('about'),
            'active' => request()->routeIs('about'),
        ],
        [
            'name' => 'Servicios',
            'route' => route('services'),
            'active' => request()->routeIs('services'),
        ],
        [
            'name' => 'Contacto',
            'route' => route('contact'),
            'active' => request()->routeIs('contact'),
        ],
    ];
@endphp

<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="navbar navbar-expand-lg custom_nav-container ">
                        <a class="navbar-brand" href="{{route('home')}}">
                            <span>
                                FacturaciónWeb
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex  flex-column flex-lg-row align-items-center">
                                <nav>
                                    <ul class="navbar-nav">
                                        @foreach ($links as $link)
                                        
                                            <li class="nav-item {{$link['active'] ? 'active' : ''}}">
                                                <a class="nav-link" href="{{$link['route']}}">
                                                    {{$link['name']}} 
                                                    @if ($link['active'])
                                                        <span class="sr-only">(current)</span>
                                                    @endif
                                                </a>
                                            </li>

                                        @endforeach
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('dashboard')}}">
                                                <span class="badge bg-secondary py-2 px-3">
                                                    Ingresar Al Sistema
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                {{-- <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                    <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header section -->

    @if (request()->routeIs('home'))
    
        <!-- slider section -->
        <section class=" slider_section ">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="slider_detail-box">
                                        <h1>
                                            Inicia <br />
                                            tu negocio con <br />
                                            Nuestra Empresa
                                        </h1>
                                        <p>
                                            Inicia tu negocio con nosotros y optimiza tus procesos comerciales con nuestras soluciones de facturación electrónica en Perú (SUNAT). ¡Potencia tu éxito empresarial desde el primer día!
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="slider_img-box">
                                        <img src="images/slider-img.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="slider_detail-box">
                                        <h1>
                                            Inicia <br />
                                            tu negocio con <br />
                                            Nuestra Empresa
                                        </h1>
                                        <p>
                                            Inicia tu negocio con nosotros y optimiza tus procesos comerciales con nuestras soluciones de facturación electrónica en Perú (SUNAT). ¡Potencia tu éxito empresarial desde el primer día!
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="slider_img-box">
                                        <img src="images/slider-img.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="slider_detail-box">
                                        <h1>
                                            Inicia <br />
                                            tu negocio con <br />
                                            Nuestra Empresa
                                        </h1>
                                        <p>
                                            Inicia tu negocio con nosotros y optimiza tus procesos comerciales con nuestras soluciones de facturación electrónica en Perú (SUNAT). ¡Potencia tu éxito empresarial desde el primer día!
                                        </p>
                                        <div class="btn-box">
                                            <a href="" class="btn-1">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="slider_img-box">
                                        <img src="images/slider-img.png" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel_btn-container">
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                        data-slide="prev">
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                        data-slide="next">
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>
        <!-- end slider section -->

    @endif

</div>