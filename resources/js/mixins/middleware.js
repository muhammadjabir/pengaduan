
import {mapActions, mapGetters} from 'vuex'
export default {
    data(){
        return {
            config:null
        }
    },

    mounted() {

    },

    computed: {
        ...mapGetters({
            token:'auth/token'
        })
    },

    created(){
        this.config = {
            headers: {
                'Authorization': 'Bearer ' + this.token,
            }
        }
    }
}
