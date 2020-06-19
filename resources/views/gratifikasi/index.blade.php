@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <form action="{{route('gratifikasi.store')}}" method="post" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="">nama lengkap pemberi</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="nama lengkap pemberi" name="nama_pemberi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">pekerjaan</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="pekerjaan" name="pekerjaan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">No HP</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="No HP" name="nohp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Peristiwa/Tgl Terima</label>
                                <br>
                                <div class="">
                                <input type="date" class="form-control"  placeholder="" name="tgl_terima">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Alasan Pemberian</label>
                                <br>
                                <div class="">
                                <textarea name="alasan" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="">Jenis Laporan</label>
                                <div class="">
                                    <select class="form-control" name="jenis">
                                        <option value="1">Laporan Penerimaan</option>
                                        <option value="0">Laporan Penolakan</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Alamat</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="Alamat" name="alamat">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="">Hubungan dengan pemberi</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="Hubungan dengan pemberi" name="hubungan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Lokasi Diterima</label>
                                <br>
                                <div class="">
                                <input type="text" class="form-control"  placeholder="Masukan Alasan" name="lokasi">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">Kronologi Penerimaan</label>
                                <br>
                                <div class="">
                                <textarea name="kronologi" placeholder="Masukan Kronologi" id="" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--
                    <div class="form-group">
                        <label for="exampleFormControlFile1">File</label>
                        <input type="file" class="form-control-file" name="file_pengaduan">
                    </div> --}}
                </div>


            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Barang</h5>
                </div>

                <div class="card-body">
                    <div class="form-barang">
                        <button class="btn btn-small btn-success" id="button-barang">Tambah Barang</button>

                    </div>

                    <input type="submit" value="Kirim" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).on('click','#button-barang',function(e) {
        e.preventDefault()
        $('.form-barang').append(`
        <div class="card-barang p-4 mb-4" style="border: 1px solid black; position: relative;">
            <button class="btn btn-small btn-danger btn-close" style="position: absolute; right:0px;top:0px;" >X</button>
            <div class="form-group">
                <label class="">Nama Barang</label>
                <br>
                <div class="">
                <input type="text" class="form-control"  placeholder="Nama Barang" name="nama_barang[]">
                </div>
            </div>
            <div class="form-group">
                <label class="">Jenis Barang</label>
                <br>
                <div class="">
                <input type="text" class="form-control"  placeholder="Jenis Barang" name="jenis_barang[]">
                </div>
            </div>
            <div class="form-group">
                <label class="">Taksiran Harga</label>
                <br>
                <div class="">
                <input type="text" class="form-control"  placeholder="Taksiran Harga" name="taksiran_harga[]">
                </div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlFile1">File</label>
                <input type="file" class="form-control-file" name="file_barang[]">
            </div>
        </div>
        `)
    })

    $(document).on('click','.btn-close',function(e){
        e.preventDefault()
        $(this).parents('.card-barang').remove()

    })

</script>
@endsection
