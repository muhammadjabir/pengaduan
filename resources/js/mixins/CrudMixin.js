import Progress from '../components/Progress'
import {mapActions, mapGetters} from 'vuex'
import middleware from './middleware'

export default {
    data(){
        return {
            data : [],
            page: null,
            lengthpage: null,
            loading:true,
            keyword:'',
            urlcreate: '',
            url: '',
            dialog:false,
            idDelete: null
        }
    },

    components:{
        'Progress' : Progress
    },

    mixins:[middleware],
    methods : {
        ...mapActions({
            setSnakbar:'snakbar/setSnakbar'
        }),

        // method ambil data
        async go(){
            let url = this.url
            if(this.page > 1) {
                url = url + '?page=' +this.page + "&keyword=" + this.keyword
            }else{
                url = url + "?keyword=" + this.keyword
            }
            await this.axios.get(url,this.config)
            .then((ress)=>{
                this.data = ress.data.data
                this.page = ress.data.current_page
                this.lengthpage = ress.data.last_page
            })
            .catch((err)=>{
                console.log(err.response)
            })
            this.loading = false
        },

        // method edit
        edit(id){
            let url = this.url + `/${id}/edit`
            console.log(url)
            this.$router.push(url)
        },

        // method delete
        deleteData(){
            let url = this.url + `/${this.idDelete}`
            this.axios.delete(url,this.config)
            .then((ress) => {
                console.log(ress)
                this.setSnakbar({
                    color:'success',
                    pesan:ress.data.message,
                    status:true
                })
                let index = this.data.map(x => {
                    return x.id
                }).indexOf(this.idDelete)

                this.data.splice(index,1)
                this.dialog = false
            })
            .catch((err)=>{
                console.log(err.response)
                this.setSnakbar({
                    pesan:err.response.data.message,
                    status:true
                })
            })
        },

        dialogDelete(id){
            this.idDelete = id
            this.dialog = true
        },
        dokumentUrl(url){
            window.open(url);
        }
    },

    mounted() {

    },

    created(){
        this.url = window.location.pathname
        this.go()
        this.urlcreate = this.url + '/create'
    }
}
