@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-4" >
        <div class="card-body">

                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Total Respon</th>
                        <th scope="col">Total Nilai</th>
                        <th scope="col">Persen</th>
                      </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($pertanyaan); $i++)
                            <tr>
                            <td>{{$pertanyaan[$i]['pertanyaan']}}</td>
                            <td>{{$pertanyaan[$i]['total_respon']}}</td>
                            <td>{{$pertanyaan[$i]['total_nilai']}}</td>
                            <td>{{$pertanyaan[$i]['total_persen']}}%</td>
                          </tr>
                        @endfor
                      {{-- @foreach ($pertanyaan as $item)
                      <tr>
                        <td>{{$item->pertanyaan}}</td>
                        <td>{{$item->total_respon}}</td>
                        <td>{{$item->total_nilai}}</td>
                        <td>{{$item->total_persen}}</td>
                      </tr>
                      @endforeach --}}
                    </tbody>
                  </table>
        </div>
    </div>

</div>
@endsection
