import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        nama_kategori: '',
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
