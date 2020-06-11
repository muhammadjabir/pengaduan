<template>
  <div class="text-center">
    <v-dialog
      v-model="DataDialog"
      width="500"
    >
      <v-card
      tile
      >
        <v-card-title
          class="teal darken-2 white--text"
          primary-title
        >
          Edit Profile
        </v-card-title>

        <v-card-text>
          <v-container>
               <v-form
                    ref="form"
                    v-model="valid"
                    :lazy-validation="lazy"
                    >

                    <v-text-field
                    v-model="user.email"
                    label="Email"
                    disabled
                    ></v-text-field>

                    <v-text-field
                    v-model="name"
                    :rules="nameRules"
                    label="Name"
                    required
                    ></v-text-field>

                    <v-text-field
                    v-model="password"
                    label="New Password"
                    type="password"
                    ></v-text-field>

                    <v-text-field
                    v-model="passwordConfirm"
                    :rules="[passwordConfirmRules(password)]"
                    label="Password Confirmation"
                    type="password"
                    ></v-text-field>

                    <v-img style="cursor:pointer" :src="imgurl" @click="$refs.foto_profile.click()"></v-img>
               </v-form>
               <input type="file" style="display:none; " id="foto_profile" ref="foto_profile" accept="image/*" @change="eventChange">
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="red"
            tile
            class="white--text"
            @click="setDialog(false)"
          >
            Cancel
          </v-btn>

           <v-btn
            color="success"
            tile
            @click="save()"
            :loading="loading"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex'
import middleware from '../../mixins/middleware'
  export default {
   methods:{
       ...mapActions({
           setDialog : 'dialog/setDialog',
           setAuth : 'auth/setAuth' ,
           setSnakbar : 'snakbar/setSnakbar'
       }),

       async save(){
           this.loading = true
           let data = new FormData()
           data.append('name',this.name)
           data.append('id',this.user.id)
           data.append('password',this.password)
           data.append('foto_profile',this.foto)
           await this.axios.post('/edit-profile',data,this.config)
           .then((ress) => {
               this.setAuth({
                   user : ress.data.user,
               })

               this.setSnakbar({
                   color:'success',
                   pesan : 'Berhasil Edit Profile',
                   status: true
               })

               this.setDialog(false)
           })
           .catch((err) => console.log(err.response))
           this.loading = false
       },

       eventChange(event){
           const files = event.target.files
            this.foto = files[0]
             const fileReader = new FileReader()
            fileReader.addEventListener('load',()=>{
                this.imgurl=fileReader.result
            })
             fileReader.readAsDataURL(this.foto)
       }
   },

   mixins:[middleware],

   data: () => ({
        valid: true,
        lazy:false,
        loading:false,
        name:'',
        password:'',
        passwordConfirm:'',
        nameRules: [
          v => !!v || 'Tidak Boleh Kosong',
        ],
        passwordConfirmRules(password){
            return v => v === password || 'Harus sama'
        },
        imgurl:'http://localhost:8000/storage/defaultprofile.jpg',
        foto:null

   }),

   computed:{
       ...mapGetters({
           dialog:'dialog/dialog',
           user:'auth/user'
       }),

       DataDialog : {
           get(){
               return this.dialog
           },
           set(){
               this.setDialog(false)
           }
       },
   },

   created(){
       this.name = this.user.name
       this.imgurl = this.user.foto_profile ? this.user.foto_profile : this.imgurl
   }
  }
</script>
