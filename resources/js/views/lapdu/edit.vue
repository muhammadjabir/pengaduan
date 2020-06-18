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
                                <h2>Data Pengaduan</h2>
                                <br>
                                <p>Nama Pegawai : {{ nama_pegawai }}</p>

                                <p>Subjek : {{ subjek }}</p>

                                <p>Isi Pengaduan :</p>
                                <div v-html="isi_pengaduan" style="border:1px solid black"></div>
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
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                        <v-form
                        ref="form"
                        v-model="valid"
                        :lazy-validation="lazy"
                        >
                        <label for="" align="left">Jawab</label>

                        <ckeditor height="400px" :editor="editor" v-model="jawaban" :config="editorConfig"></ckeditor>
                        <v-row>
                            <v-col
                            cols="12"
                            align="right"
                            >
                              <v-btn
                                :disabled="!valid"
                                color="success"
                                tile
                                @click="save()"
                                :loading="loading"
                                >
                                Simpan
                                </v-btn>
                            </v-col>
                        </v-row>

                    </v-form>
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
export default {
    name: 'elapdu.edit',

    mixins:[Lapdu],
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
             this.isi_pengaduan = lapdu.isi_pengaduan
             this.nama_pegawai = lapdu.nama_pegawai
             this.subjek = lapdu.subjek
             this.nama_warga = warga.nama
             this.ktp = warga.ktp
             this.alamat = warga.alamat
             this.nohp = warga.nohp
             this.email = warga.email
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
