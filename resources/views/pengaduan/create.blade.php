@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
    <div class="card-header "> 
      <h3>Form Pelayanan Hukum Online</h3>  
    </div>
  
    <div class="row justify-content-center my-3">
   
<!--syarat dan ketentuan -->
                <div class="col-lg-4">
                    <div class="container">
                    <div class="card">
                    
                            <div class="card-header">
                                Syarat dan Ketentuan 
                            </div>
                            <div class="card-body">
                            <p >Penerimaan permohonan pelayanan hukum melalui website ini adalah untuk memberikan pelayanan hukum yang berkaitan dengan</p>
                            <hr>
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item ">
                                    <i class=" fa fa-check text-success position-left"></i>
                                    Keperdataan
                                </li>
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>
                                    Pertanahan
                                </li>
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>
                                    Tata Usaha Negara
                                </li>
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>
                                    Waris
                                </li>
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>
                                    Keperdataan
                                </li>
                            </ul>
                            
                            <p class="mt-3">
                                Kami tidak akan menidaklanjuti: <hr>
                            </p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>
                                    Permohonan yang tidak mencantumkan identitas yang lengkap (anonim).
                                </li>
                                <li class="list-group-item ">
                                    <i class="fa fa-check text-success position-left"></i>Pertanyaan yang berhubungan dengan materi perkara pidana
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer text-muted">
                            <strong>Catatan:</strong><br>
                            Jawaban akan kami kirimkan melalui email Anda, dan apabila Anda mengijinkan, akan tayang pada halaman Beranda.
                    
                        </div>
                        
                    </div>
                </div>
            </div>
                <!--end syarat dan ketentuan -->

                <div class="col-12 col-md-8">
                    <div class="container">
                    <form action="{{route('pengaduan.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card" >
                            <div class="card-header">
                                <h5 class="card-tittle">Data Diri</h5>
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
                                <h5 class="card-title">Data Pertanyaan</h5>
                            </div>
                            <div class="card-body">
                        
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tampilkan Untuk Publik</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="status_public">
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="id_kategori">
                                        @foreach ($kategories as $item)
                                            <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

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
             </div>
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
