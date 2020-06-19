import {mapActions} from 'vuex'
import middleware from './middleware'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        nama_warga: '',
        editor: ClassicEditor,
        editorConfig: {},
        alamat:'',
        nohp:'',
        email:'',
        ktp:'',
        subjek:'',
        isi_pengaduan:'',
        kapan:'',
        dimana: '',
        jawaban:'',
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
