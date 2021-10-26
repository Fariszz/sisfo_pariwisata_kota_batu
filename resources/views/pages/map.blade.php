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
            .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
            .setHTML('<h3>' + marker.properties.title + '</h3> <p><img src="/storage/'+ marker.properties.image +'"alt="Gambar" class="img-fluid pt-2 w-2"> </p>'))
            .addTo(map);
    });

    //! gagal
    document.getElementById('fly').addEventListener('click', () => {
        // Fly to a random location by offsetting the point -74.50, 40
        // by up to 5 degrees.

        dataMap.features.forEach(function(marker){
            console.log(marker.properties.id);
            map.flyTo({
                center: marker.geometry.coordinates,
                essential: true,
                zoom: 13,
                bearing: 0,
                curve: 1
            });
            // console.log(marker.properties.title);
        });
    });

    //! gagal
    document.getElementById("viewDetail").addEventListener('click', () =>{
        dataMap.features.forEach(function(marker){
            console.log(marker);
            document.getElementById("title").innerHTML = marker.properties.title
            document.getElementById("description").innerHTML = marker.properties.description
            document.getElementById("ImagePreview").innerHTML = '<img src="/storage/'+ marker.properties.image +'"alt="Gambar" class="img-fluid">'
        });
    });

</script>

<style>
    #map {
        width: 100%;
        height: 450px;
    }
    .marker {
        background-image: url('/storage/images/point.png');
        background-repeat:no-repeat;
        background-size:100%;
        width: 50px;
        height: 100px;
        cursor: pointer;
    }

    .embed-responsive {
        width: 100%;
        height: 25vw;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid border">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Muhammad Faris Hadi Mulyo</span>
            </div>
        </nav>

        <div class="row mt-5">
            <div class="col-md">
                <div class="card shadow-sm" style="height: 100%">
                    <div id="map"></div>
                </div>
            </div>
            {{-- <div class="col-md-5">
                <div class="card shadow-sm" style="width: 100%; height: 100%;">
                    <div id="ImagePreview" class="card-img-top embed-responsive"></div>
                    <div class="card-body">
                        <h1></h1>
                        <p id="description"></p>
                    </div>
                </div>
            </div> --}}
        </div>

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
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mt-5" >
                        <div class="card-header bg-primary text-white">
                            <h2><strong>Tambah Penanda Baru</strong></h2>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('google.map.store') }}" method="POST" id="boxmap" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        {{-- <label for="title">Title</label> --}}
                                        <input type="text" name="title" placeholder="Title" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="title">Description</label> --}}
                                        <input type="text" name="description" placeholder="Description" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="lat">lat</label> --}}
                                        <input type="text" name="lat" placeholder="latitude" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label for="lng">lng</label> --}}
                                        <input type="text" name="lng" placeholder="longtitude" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" placeholder="image" class="form-control-file"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit" value="Add Map" class="btn btn-primary w-full"/>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow mt-5" style="height: 80%">
                        <div class="card-header bg-primary text-white">
                            <h2><strong>Tempat Pariwisata</strong></h2>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Longitude</th>
                                        <th scope="col">Latitude</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataMaps as $dataMap)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{  $dataMap->title }}</td>
                                        <td>{{ $dataMap->lng }}</td>
                                        <td>{{ $dataMap->lat }}</td>
                                        {{-- <td><a class="btn btn-info" href="{{ route('google.map.show',$dataMap->id) }}">Show</a></td> --}}
                                        <td><button type="submit" id="buttonDetail" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $dataMap->id }}">
                                            <i class="bi bi-eye" style="color: white;"></i>
                                        </button>
                                        <div class="modal fade border border-radius" id="exampleModal-{{ $dataMap->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">{{ $dataMap->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <img src="/storage/{{ $dataMap->image }}" alt="" class="img img-fluid">
                                                <div class="modal-body">
                                                        {{ $dataMap->description }}
                                                </div>
                                                <div class="modal-footer">
                                                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                                                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $dataMaps->links() }}
                        </div>
                </div>
            </div>
    </div>
@endsection
