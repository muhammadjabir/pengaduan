@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-4" >
        <div class="card-body">
            <a href="{{route('pertanyaan.detail')}}" class="btn btn-primary">Result</a>
            <form action="{{route('pertanyaan.store')}}" method="POST" >
                @csrf
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan Anda" required>
                    </div>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Pertanyaan</th>
                        <th scope="col">Sangat Memuaskan</th>
                        <th scope="col">Memuaskan</th>
                        <th scope="col">Biasa</th>
                        <th scope="col">Kurang Memuaskan</th>
                        <th scope="col">Sangat Kurang Memuaskan</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($pertanyaan as $index => $item)
                      <tr>
                        <th>{{$item->description}}</th>
                        <td><input type="radio" name="pertanyaan_{{$index}}" checked value="sangat memuaskan"></td>
                        <td><input type="radio" name="pertanyaan_{{$index}}" value="memuaskan"></td>
                        <td><input type="radio" name="pertanyaan_{{$index}}" value="biasa"></td>
                        <td><input type="radio" name="pertanyaan_{{$index}}" value="kurang memuaskan"></td>
                        <td><input type="radio" name="pertanyaan_{{$index}}" value="sangat kurang"></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <input type="submit" value="Kirim" class="btn btn-success">
            </form>
        </div>
    </div>

</div>
@endsection
