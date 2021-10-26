<!DOCTYPE html>
<html>
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- Styles -->
<script src="{{asset('js/app.js')}}" defer></script>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
<script src="https://use.fontawesome.com/a18af7dda5.js"></script>
  </head>
  <body>
    <div >
        @yield('content')
    </div>
  </body>
<style>

    body{
        background-color: #fafafa;
    }
        /* .mapboxgl-popup {
            width: 800px;
            max-width: 500px;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
        .mapboxgl-popup-content {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
        } */
        .mapboxgl-popup {
            padding-bottom: 50px;
        }

        .mapboxgl-popup-close-button {
            display: none;
        }
        .mapboxgl-popup-content {
            font: 400 15px/22px 'Source Sans Pro', 'Helvetica Neue', sans-serif;
            padding: 0;
            width: 180px;
        }
        .mapboxgl-popup-content h3 {
            background: #0D6EFD;
            color: #fff;
            margin: 0;
            padding: 10px;
            border-radius: 3px 3px 0 0;
            font-weight: 700;
            margin-top: -15px;
        }

        .mapboxgl-popup-content h4 {
            margin: 0;
            padding: 10px;
            font-weight: 400;
        }

        .mapboxgl-popup-content div {
            padding: 10px;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-content {
            margin-top: 15px;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-tip {
            border-bottom-color: #91c949;
        }
</style>
@yield('script')
</html>
