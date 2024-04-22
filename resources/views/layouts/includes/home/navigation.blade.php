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

<style></style>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Встреча с директором</title><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400&display=swap" em-class="em-font-Rubik-Regular"><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,700&display=swap" em-class="em-font-Rubik-Bold"><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,900&display=swap" em-class="em-font-Rubik-Black">
	
	
	
	<style type="text/css">
		html {
			-webkit-text-size-adjust: none;
			-ms-text-size-adjust: none;
		}
	</style>
	<style em="styles">
.em-font-Rubik-Black,.em-font-Rubik-ExtraBold {
    font-family: Rubik,sans-serif!important;
}
.em-font-Rubik-Black {
    font-weight: 900!important;
}
.em-font-Rubik-Bold,.em-font-Rubik-Regular {
    font-family: "Rubik",sans-serif!important;
    font-weight: 700!important;
}
.em-font-Rubik-Regular {
    font-weight: 400!important;
}
@media only screen and (max-device-width:660px),only screen and (max-width:660px) {
    .em-narrow-table {
        width: 100%!important;
        max-width: 660px!important;
        min-width: 300px!important;
    }
    .em-mob-wrap.em-mob-wrap-cancel,.noresp-em-mob-wrap.em-mob-wrap-cancel {
        display: table-cell!important;
    }
    .em-mob-font_size-45px {
        font-size: 45px!important;
    }
    .em-mob-font_size-20px {
        font-size: 20px!important;
    }
    .em-mob-line_height-28px {
        line-height: 28px!important;
    }
    .em-mob-font_size-14px {
        font-size: 14px!important;
    }
    .em-mob-line_height-18px {
        line-height: 18px!important;
    }
    .em-mob-padding_bottom-15 {
        padding-bottom: 15px!important;
    }
    .em-mob-width-auto {
        width: auto!important;
    }
    .em-mob-padding_top-20 {
        padding-top: 20px!important;
    }
    .em-mob-padding_bottom-20 {
        padding-bottom: 20px!important;
    }
    .em-mob-padding_top-10 {
        padding-top: 10px!important;
    }
    .em-mob-padding_right-10 {
        padding-right: 10px!important;
    }
    .em-mob-padding_bottom-10 {
        padding-bottom: 10px!important;
    }
    .em-mob-padding_left-10 {
        padding-left: 10px!important;
    }
    .em-mob-font_size-26px {
        font-size: 26px!important;
    }
    .em-mob-line_height-32px {
        line-height: 32px!important;
    }
    .em-mob-width-100perc {
        width: 100%!important;
        max-width: 100%!important;
    }
    .em-mob-wrap {
        display: block!important;
    }
    .em-mob-padding_right-20 {
        padding-right: 20px!important;
    }
    .em-mob-padding_left-20 {
        padding-left: 20px!important;
    }
}
</style>
</head>