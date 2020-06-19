<template>
    <v-app>
        <v-row>
            <v-col
                    cols="12"
                    md="12"
                >
                <v-container>
                    <v-btn small color="teal darken-2" class="white--text" tile>Data Laporan Pengaduan</v-btn>
                    <v-card
                    class="border-edit"
                    tile
                    >
                        <!-- <v-card-text class="text-center"> -->
                        <v-card-text>
                            <v-container>
                                <h2>Data Pelapor</h2>
                                <br>
                                <p>Nama Lengkap : {{ nama_warga }}</p>

                                <p>No KTP : {{ ktp }}</p>

                                <p>Alamat : {{ alamat }}</p>

                                <p>E-Mail : {{ email }}</p>

                                <p>No HP : {{ nohp }}</p>
                                <br>

                            </v-container>

                        </v-card-text>

                        <v-card-actions class="">

                        </v-card-actions>
                    </v-card>

                    <br>
            <v-card
            class="border-edit"
            tile
            >
            <v-btn small color="teal darken-2" class="white--text" tile>Data Pengaduan</v-btn>
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                        <p>Nama pemberi: {{ nama_pemberi }}</p>

                        <p>Pekerjaan : {{ pekerjaan }}</p>

                        <p>nohp : {{ nohp }}</p>

                        <p>alasan : {{ alasan }}</p>

                        <p>alamat : {{ alamat }}</p>
                        <p>lokasi diterima : {{ lokasi_diterima }}</p>
                        <p>kronologi : {{ kronologi }}</p>
                    </v-container>

                </v-card-text>

                <v-card-actions class="">

                </v-card-actions>
            </v-card>

              <br>
            <v-card
            class="border-edit"
            tile
            >
            <v-btn small color="teal darken-2" class="white--text" tile>Data Barang</v-btn>
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                      <div v-for="barang in barangs" :key="barang.id">
                          <p>Nama Barang : {{ barang.nama_barang }}</p>
                          <p>jenis Barang : {{ barang.jenis_barang }}</p>
                          <p>Taksiran Harga : {{ barang.taksiran_harga }}</p>
                           <v-btn color="success" v-on:click="dokumentUrl(barang.file_barang)"  v-if="barang.file_barang" >
                                    Dokumen
                                </v-btn>
                                <hr>
                      </div>
                    </v-container>

                </v-card-text>

                <v-card-actions class="">

                </v-card-actions>
            </v-card>
                </v-container>
            </v-col>
        </v-row>

    </v-app>

</template>
<script>
// import {mapActions} from 'vuex'
import Lapdu from '../../mixins/LapduMixin'
import CrudMixin from '../../mixins/CrudMixin'
export default {
    name: 'elapdu.edit',

    mixins:[Lapdu,CrudMixin],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = `${url[1]}/${url[2]}`
            let data = new FormData()
            data.append('jawaban',this.jawaban)
             data.append('_method','PUT')
            await this.axios.post(url,data,this.config)
            .then((ress) => {
                console.log(ress)
                this.setSnakbar({
                    status:true,
                    pesan:ress.data.message,
                    color:'success'
                })
                this.$router.go(-1)
            })
            .catch((err)=>{
                if (err.response.status == 400 ) {
                    this.setSnakbar({
                    color:'red',
                    status:true,
                    pesan:err.response.data.message,
                    })
                }else{
                    this.setSnakbar({
                    status:true,
                    color:'red',
                    pesan:"Terjadi Kesalahan",
                    })
                }

                console.log(err.response)
            })
            this.loading = false

        },

        go(){
         let url = window.location.pathname
         this.axios.get(url,this.config)
         .then((ress) => {
             console.log(ress)
             let warga = ress.data.lapdu.warga
             let lapdu = ress.data.lapdu
             this.barangs = ress.data.lapdu.barang
             this.nama_warga = warga.nama
             this.ktp = warga.ktp
             this.alamat = warga.alamat
             this.nohp = warga.nohp
             this.email = warga.email
             this.nama_pemberi = lapdu.nama_pemberi
        this.pekerjaan = lapdu.pekerjaan
        this.nohp = lapdu.nohp
        this.tgl_terima =  lapdu.tgl_terima
        this.alasan = lapdu.alasan
        this.alamat = lapdu.alamat
        this.hubungan = lapdu.hubungan
        this.lokasi_diterima = lapdu.lokasi_diterima
        this.kronologi = lapdu.kronologi

         })
         .catch((err) => console.log(err.response))
        }

    },
    created(){
        this.go()
    }

}
</script>

<style lang="css" scoped>
</style>
