@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-4" >
        <div class="card-body">
            <h3>{{ $pengaduan->subjek }}</h3>
            <span class="text-muted">Oleh : {{$pengaduan->warga->nama}} - {{$pengaduan->created_at->format('d/m/Y H:i')}} - {{$pengaduan->kategori->nama}}</span>
            <div>
                {!! $pengaduan->isi_pengaduan !!}
            </div>
        </div>
    </div>

    <div class="card mb-4" >
        <div class="card-body">
            @if ($pengaduan->jawaban)
            <span class="text-muted">Jawaban</span>
            <div>{!! $pengaduan->jawaban !!}</div>

            <br>
            <span>By {{$pengaduan->user->name}} - {{$pengaduan->updated_at->format('d/m/Y H:i')}}</span>
            @else
                <h2 class="text-center">
                    Kami Belum Menjawab Pertanyaan Ini
                </h2>
            @endif

        </div>
    </div>
</div>
@endsection
