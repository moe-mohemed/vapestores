<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<?php
    $metaDesc = "Vape stores in Canada. Listings of Vape stores in Canada";
?>
<meta name="description" content="{{ (!empty($store['store_description']) ? $store['store_description'] : $metaDesc) }}">
<link rel="stylesheet" href="/css/app.css">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MPVG6ZZ');</script>
<!-- End Google Tag Manager -->

{{--<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:300,300i,400,400i,600,600i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,400i,600,600i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700" rel="stylesheet">--}}

<link rel="stylesheet" href="/css/libs.css">
<link rel="stylesheet" href="/css/sweetalert.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
<link href="/css/font-awesome.min.css" rel="stylesheet">
{{--<script src="/js/states.js"></script>--}}
