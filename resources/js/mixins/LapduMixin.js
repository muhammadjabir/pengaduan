import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        nama_warga: '',
        nama_pegawai:'',
        alamat:'',
        nohp:'',
        email:'',
        ktp:'',
        subjek:'',
        isi_pengaduan:'',
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),


    },

    mixins:[middleware],

    created(){
    }
}
