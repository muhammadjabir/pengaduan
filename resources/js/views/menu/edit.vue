<template>
    <v-app>
        <v-container>
            <v-btn small color="red accent-4" class="white--text" tile>Edit Menu</v-btn>
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
                        <label for="" align="left">Parent Menu</label>
                        <v-text-field
                            v-model="url"
                            :rules="urlRules"
                            label="Url"
                            required
                        ></v-text-field>
                        <v-text-field
                            v-model="description"
                            :rules="iconRules"
                            label="Description"
                            required
                        ></v-text-field>
                        <v-icon v-if="icon">{{icon}}</v-icon>

                        <v-text-field
                            v-model="icon"
                            :rules="iconRules"
                            label="Icon"
                            required
                        ></v-text-field>

                          <v-text-field
                            v-model="priority"
                            :rules="priorityRules"
                            label="Priority"
                            required
                        ></v-text-field>

                        <v-select
                            v-model="select"
                            :items="items"
                            :rules="[v => !!v || 'Item is required']"
                            label="Item"
                            item-text="text"
                            item-value="value"
                            required
                        ></v-select>
                        <v-btn tile @click="tambah()" small color="success" class="text-white" v-if="select == 1">
                            <v-icon dark>mdi-plus</v-icon> Tambah Child Menu
                        </v-btn>
                        <br>
                        <div class="child-menu"  v-if="select == 1">
                            <label for="">Child Menu</label>
                            <div v-for="(children,index) in childrens" :key="index" class="children" >
                                <v-row align="center">
                                    <v-col
                                    cols="8">
                                        <v-text-field
                                            v-model="children.url"
                                            :rules="urlRules"
                                            label="Url"
                                            required
                                        ></v-text-field>
                                        <v-text-field
                                            v-model="children.description"
                                            :rules="iconRules"
                                            label="Description"
                                            required
                                        ></v-text-field>
                                        <v-icon v-if="children.icon">{{children.icon}}</v-icon>

                                        <v-text-field
                                            v-model="children.icon"
                                            :rules="iconRules"
                                            label="Icon"
                                            required
                                        ></v-text-field>
                                    </v-col>
                                    <v-col
                                    cols="2">
                                        <v-btn tile @click="hapus(index)" dark x-small color="red" v-if="childrens.length > 1" class="btn-hapus">
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
import MenuMixin from '../../mixins/MenuMixin'
import middleware from '../../mixins/middleware'
export default {
    data: () => ({
        childrens:[]
      }),
    methods: {
        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            url = `${url[1]}/${url[2]}`
            let data = new FormData()
            data.append('menu_url',this.url)
            data.append('menu_icon',this.icon)
            data.append('status_child',this.select)
            data.append('description',this.description)
            data.append('priority',this.priority)

            if (this.childrens.length >= 1) {
                data.append('child_menu',JSON.stringify(this.childrens))
            }
            data.append('_method','PUT')
            await this.axios.post(url,data,this.config)
            .then((ress)=>{
                this.setSnakbar({
                    status:true,
                    color:'success',
                    pesan:ress.data.message
                })
                // this.$router.push('/menu')
            })
            .catch((err)=>{
                console.log(err.response)
            })
            this.loading = false
        }
    },
    created(){
        console.log(window.location.pathname)
        this.axios.get(window.location.pathname,this.config)

        .then((ress) => {
            console.log(ress)
            let response = ress.data.data
            this.description = response.description
            this.url = response.url
            this.icon = response.icon
            this.childrens = response.child_menu
            this.priority = response.priority
            this.select = response.status_child == 1 ? 1 : 2

            console.log(this.childrens)

        })
        .catch((err) =>{
            console.log(err.response)
        })
    },
    mixins:[MenuMixin,middleware]
}

</script>
<style lang="css" scoped>
    .child-menu{
        margin-top:20px;
    }
    .children{
        padding: 10px;
        border: 1px solid black;
        margin-bottom: 5px;
        position: relative;
    }
    .btn-hapus{
        position: absolute;
        top: 0;
        right: 0;
    }
</style>
