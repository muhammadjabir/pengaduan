<template>
  <div class="text-center">
    <v-snackbar
      v-model="statusSnakbar"
      :timeout="2000"
      top
      :color="color"
    >
      {{ pesan }}
      <v-btn
        class="text-white"
        text
        @click="close()"
      >
        Close
      </v-btn>
    </v-snackbar>
  </div>
</template>
<script>
import {mapGetters,mapActions} from 'vuex'
export default {
    name : 'snakbar',
    computed :{
        ...mapGetters({
            status : 'snakbar/status',
            color : 'snakbar/color',
            pesan : 'snakbar/pesan',
        }),
        statusSnakbar: {
            get(){
                return this.status
            },
            set(value){
                this.setSnakbar({
                    color:'red',
                    status:false,
                    pesan:null
                })
            }
        }



    },
    methods: {
        ...mapActions({
            setSnakbar: 'snakbar/setSnakbar'
        }),
        close(){
				this.setSnakbar({
					status:false
				})
			}
    }
}
</script>
