@extends('layouts.main')
@section('script')
<script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZmFyaXN6MTkiLCJhIjoiY2t2NjVlbW04MHI4aTJubnd5azVxZjNldyJ9.SmvSfSHzHZD2tw1SREZNEA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [112.69052297003728, -7.835733944572421], //lng,lat 10.818746, 106.629179
            // center: [-7.871114, 10.762622], //lng,lat 10.818746, 106.629179
            zoom: 7
        });
        var test ='<?php echo $dataArray;?>';  //mendapatkan data dari Controller
        var dataMap = JSON.parse(test); //Mengubah bentuk menjadi bentuk yangd dibutuhkan MapBox

        // Membuat loop untuk object dataMap
        dataMap.features.forEach(function(marker) {

            //membuat tag div dari class market,untuk
            var el = document.createElement('div');
            el.className = 'marker';

            //Membuat marker dari posisi koordinat
            new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .setPopup(new mapboxgl.Popup({ offset: 50 }) // add popups
            .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'
                    + '<img src="/storage/'+ marker.properties.image +'" alt="Gambar" width="100px">'))
                .addTo(map);
        });
    </script>
    <style>
        #map {
            width: 200%;
            height:500px;
        }
        .marker {
            background-image: url('/storage/images/point.png');
            background-repeat:no-repeat;
            background-size:100%;
            width: 50px;
            height: 100px;
            cursor: pointer;
        }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2>Google Map</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <form action="{{ route('google.map.store') }}" method="POST" id="boxmap" enctype="multipart/form-data">
        @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="Title" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="title">Description</label>
                    <input type="text" name="description" placeholder="Description" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="lat">lat</label>
                    <input type="text" name="lat" placeholder="lat" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="lng">lng</label>
                    <input type="text" name="lng" placeholder="lng" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" placeholder="image" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Add Map" class="btn btn-success"/>
                </div>
        </form>
        </div>
        <div class="col-md-8">
            <h2>Show google Map</h2>
            <div id="map"></div>
        </div>
    </div>
</div>

@endsection
