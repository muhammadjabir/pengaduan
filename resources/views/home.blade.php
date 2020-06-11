@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-title">Kategori</h5>
                    <div class="list-group">
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action">Semua Kategori</a>
                        @foreach ($kategori as $item)
                        <a href="{{ route('home',['kategori'=>$item->slug]) }}" class="list-group-item list-group-item-action">{{$item->slug}}</a>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            @foreach ($pengaduan as $item)
            <div class="card mb-4" >
                <div class="card-body">
                    <h5 class="card-title"><span class="badge badge-primary">{{$item->kategori->nama_kategori}}</span>
                        {{$item->created_at->format('Y-m-d H:i')}}
                        oleh : {{$item->warga->nama}}</h5>
                    <div>
                        <h2>{{ $item->subjek }}</h2>
                       {!! $item->isi_pengaduan !!}
                    </div>

                    <a href="{{ route('pengaduan.detail',['id'=>$item->id]) }}" class="btn btn-primary">Selengkapnya</a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
