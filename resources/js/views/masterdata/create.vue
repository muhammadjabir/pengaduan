<template>
    <v-app>
        <v-container>
            <v-btn small color="red accent-4" class="white--text" tile>Tambah Master Data</v-btn>
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
                        <label for="" align="left">Master Data</label>
                        <v-text-field
                        v-model="description"
                        :rules="descriptionRules"
                        label="Description"
                        required
                        ></v-text-field>
                        <v-btn tile @click="tambah()" small color="success" class="text-white">
                            <v-icon dark>mdi-plus</v-icon> Tambah Children
                        </v-btn>
                        <br>
                        <div class="form-childer" >
                            <label for="">Children</label>
                                <div v-for="(children, index) in childrens" :key="index">
                                    <v-row align="center">
                                        <v-col
                                            cols="10"
                                        >
                                            <v-text-field
                                                v-model="children.description"
                                                :rules="children.descriptionRules"
                                                label="Description"
                                                required
                                            ></v-text-field>
                                        </v-col>

                                        <v-col
                                            cols="2"
                                        >
                                            <v-btn fab @click="hapus(index)" dark x-small color="red" v-if="childrens.length > 1">
                                                <v-icon dark>mdi-close</v-icon>
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </div>
                        </div>

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
import MasterdataMixin from '../../mixins/MasterdataMixin'
import middleware from '../../mixins/middleware'
export default {
    name: 'masterdata.edit',

    mixins:[MasterdataMixin,middleware],
    methods:{
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = "/" + url[1]
            let data = new FormData()
            data.append('masterdata',this.description)
            data.append('childrens',JSON.stringify(this.childrens))

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
                 this.setSnakbar({
                    status:true,
                    pesan:"Terjadi Kesalahan",
                })
                console.log(err)
            })
            this.loading = false

        }
    }

}
</script>

<style lang="css" scoped>
    .form-childer{
        margin-top:20px;
        border: 1px solid ;
        padding: 10px;
    }
</style>
