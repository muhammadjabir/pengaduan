@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            <div class="card-header text-white bg-success">  
                <h4 class="card-title my-1">PELAYANAN HUKUM ONLINE</h4>
            </div>  
            
            <div class="card">
                <div class="card-body">  
                    <p class="card-text"> 
                    <b> Pelayanan Hukum Terpadu Kejaksaan RI </b> adalah sebuah sarana untuk memberikan akses pelayanan hukum secara cuma-cuma dan terpadu dengan Kejaksaan Tinggi dan Kejaksaan Negeri di seluruh Indonesia. Aplikasi ini dikembangkan oleh <b><i> KN. KABUPATEN BOGOR </b></i>dalam rangka menjalankan tugas dan wewenangnya memberikan Pelayanan Hukum.
                        Yang dimaksud dengan <b>pelayanan hukum yaitu semua bentuk pelanyanan yang diperlukan oleh instansi negara atau pemerintah atau masyarakat yang berkaitan dengan atau masalah perdata maupun tata usaha negara.</b>
                    </p>
                    <a class="nav-link" href="{{ route('pengaduan.create') }}">
                    <button type="button" class="btn btn-success">Masukkan Pertanyaan Anda <i class="fa fa-arrow-right"></i></button>
                </a>
                </div>  
            </div>
        </div>                 
        <div class="col-12 col-md-8">  
            <div class="card">
             <img src="{{asset("/storage/foto_profile/header.png")}}" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    </div>
    </div>
</div>

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 mb-3">
            <div class="card" >
                <div class="card-body">
                    <h5 class="card-header bg-success text-white">Kategori</h5>
                    <div class="list-group">
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action"><i class="fa fa-list-alt" aria-hidden="true"></i> Semua Kategori</a>
                        @foreach ($kategori as $item)
                        <a href="{{ route('home',['kategori'=>$item->slug]) }}" class="list-group-item list-group-item-action"> <i class="fa fa-list-alt" aria-hidden="true"></i> {{$item->slug}}</a>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            @foreach ($pengaduan as $item)

            <div class="card  mb-4" >
                <div class="card-header text-white bg-success">  <p class="my-1 card-title"><span class="badge badge-warning">{{$item->kategori->nama_kategori}}</span>
                    {{$item->created_at->format('Y-m-d H:i')}}
                    oleh : {{$item->warga->nama}}</p>
                </div>
                <div class="card-body">
                  <h2 class="card-title ">{{ $item->subjek }}</h2>
                  <p class="card-text"> {!! $item->isi_pengaduan !!}</p>
                  <a href="{{ route('pengaduan.detail',['id'=>$item->id]) }}" class="btn btn-success">Selengkapnya</a>
                </div>
               
              </div>
           
            @endforeach

        </div>
    </div>
</div>
@endsection
