import {mapActions} from 'vuex'
import middleware from './middleware'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        editor: ClassicEditor,
        editorConfig: {},
        jawaban: '',
        penanya:'',
        subjek:'',
        pertanyaan:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ]
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
