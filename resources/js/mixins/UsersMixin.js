import {mapActions} from 'vuex'
import middleware from './middleware'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        select:'',
        items:[],
        name: '',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        password: '',
        passwordRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        email: '',
        emailRules: [
          v => !!v || 'E-mail is required',
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),

        getRole(){
            this.axios.get(window.location.pathname,this.config)
            .then((ress) => {
                this.items = ress.data.roles
            })
            .catch((err) => console.log(err))
        }

    },

    mixins:[middleware],

    created(){
        this.getRole()
    }
}
