import {mapActions} from 'vuex'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        description: '',
        descriptionRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        childrens:[
            {
              description:'',
              descriptionRules: [
                  v => !!v || 'Tidak Boleh Kosong',
              ],
            }
        ]
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        tambah(){
            this.childrens.push({id:0,description:'',descriptionRules: [
                v => !!v || 'Tidak Boleh Kosong',
            ],})
        },
        hapus(index){
            this.childrens.splice(index,1)
        },
    },
}
