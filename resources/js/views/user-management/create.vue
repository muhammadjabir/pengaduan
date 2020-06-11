<template>
    <v-app>
        <v-container>
            <v-btn small color="red accent-4" class="white--text" tile>Tambah User</v-btn>
            <v-card
            class="border-edit"
            tile
            >
                <!-- <v-card-text class="text-center"> -->
                <v-card-text>
                    <v-container>
                        <v-form
                        ref="form"
                        v-model="valid"
                        :lazy-validation="lazy"
                        >
                        <label for="" align="left">User Baru</label>

                        <v-text-field
                        v-model="name"
                        :rules="nameRules"
                        label="Name"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="Email"
                        required
                        ></v-text-field>

                        <v-text-field
                        v-model="password"
                        :rules="passwordRules"
                        label="Password"
                        type="password"
                        required
                        ></v-text-field>

                        <v-select
                            v-model="select"
                            :items="items"
                            :rules="[v => !!v || 'Item is required']"
                            label="Role"
                            item-text="description"
                            item-value="id"
                            required
                        ></v-select>


                        <v-row>
                            <v-col
                            cols="12"
                            align="right"
                            >
                              <v-btn
                                :disabled="!valid"
                                color="success"
                                tile
                                @click="save()"
                                :loading="loading"
                                >
                                Simpan
                                </v-btn>
                            </v-col>
                        </v-row>

                    </v-form>
                    </v-container>

                </v-card-text>

                <v-card-actions class="">

                </v-card-actions>
            </v-card>
        </v-container>
    </v-app>

</template>
<script>
// import {mapActions} from 'vuex'
import UsersMixin from '../../mixins/UsersMixin'
import middleware from '../../mixins/middleware'
export default {
    name: 'masterdata.edit',

    mixins:[UsersMixin,middleware],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = "/" + url[1]
            let data = new FormData()
            data.append('name',this.name)
            data.append('email',this.email)
            data.append('password',this.password)
            data.append('id_role' , this.select)

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                console.log(ress)
                this.setSnakbar({
                    status:true,
                    pesan:ress.data.message,
                    color:'success'
                })
                this.$router.push(url)
            })
            .catch((err)=>{
                if (err.response.status == 400 ) {
                    this.setSnakbar({
                    color:'red',
                    status:true,
                    pesan:err.response.data.message,
                    })
                }else{
                    this.setSnakbar({
                    status:true,
                    color:'red',
                    pesan:"Terjadi Kesalahan",
                    })
                }

                console.log(err.response)
            })
            this.loading = false

        },

    }

}
</script>

<style lang="css" scoped>
</style>
