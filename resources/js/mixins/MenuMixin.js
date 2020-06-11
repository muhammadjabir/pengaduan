import {mapActions} from 'vuex'
export default {
    data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        icon: '',
        select: '',
        description:'',
        items: [
            {
                value:2,
                text:'Tanpa Child Menu'
            },
            {
                value:1,
                text:'Dengan Child Menu'
            }
        ],
        iconRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        url:'',
        urlRules:[
            v => !! v || 'Tidak boleh kosong',
            v => /^\//.test(v) || 'Harus diawali /'
        ],
        priority:'',
        priorityRules:[
          v => !!v || 'Tidak Boleh Kosong',
          v => /^\d+$/.test(v) || 'Harus angka'
        ],
        childrens:[
            {
              icon:'',
              url:'',
              description:'',
            }
        ]
      }),
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        tambah(){
            this.childrens.push({
                id:0,
                url:'',
                icon:'',
                description:''
            })
        },
        hapus(index){
            this.childrens.splice(index,1)
        },
    },
}
