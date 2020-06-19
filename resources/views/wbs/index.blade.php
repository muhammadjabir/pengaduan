@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header ">
        <h3>Wbs</h3>
        </div>

        <div class="card-body">
            <form action="" name="cari">
                <input type="text" name="kode" value="No Registrasi">
                 <button type="submit">Cari</button>
            </form>
        </div>
    </div>

    <div class="">
        <form action="{{route('wbs.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card" >
                <div class="card-header">
                    <h5 class="card-tittle">Data Pelapor</h5>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control"  placeholder="Nama Lengkap" name="nama_lengkap">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">KTP</label>
                        <div class="col-sm-10">
                        <input type="text" name="ktp" class="form-control" placeholder="No KTP">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat Sesuai KTP</label>
                        <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                        <input type="text" name="nohp" class="form-control" placeholder="nohp">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" >
                <div class="card-header">
                    <h5 class="card-title">Data Pengaduan</h5>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Subyek</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control"  placeholder="Subyek" name="subjek">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Isi Pengaduan</label>
                        <div class="col-sm-10">
                        <textarea name="isi_pengaduan" id="editor" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input type="file" class="form-control-file" name="file_pengaduan">
                    </div>
                </div>

                <input type="submit" value="Kirim" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endsection
