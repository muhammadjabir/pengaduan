<template>
    <v-app>
        <v-container >
            <v-btn small color="red accent-4" class="white--text" tile>{{role}}</v-btn>
            <v-card
            class="border-edit"
            tile
            >
                <v-card-text>
                    <v-card
                        class="mx-auto"
                        outlined
                    >
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title>Menu</v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-action>
                            <v-checkbox
                                v-model="checkbox"
                                @change="chekAll()"
                            >
                            </v-checkbox>
                            </v-list-item-action>
                            <v-btn color="success" class="mr-3" @click="save()" :loading="loading" small tile >Simpan</v-btn>

                            <v-btn color="primary"  to="/menu" small tile>
                                    Menu Management
                            </v-btn>
                        </v-list-item>

                        <v-card-text>
                            <v-card v-for="(menu,index) in menus" :key="index" class="mt-4">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>{{menu.description}}</v-list-item-title>
                                    </v-list-item-content>
                                    <v-list-item-action>
                                    <v-checkbox
                                        v-model="menu.checkbox"
                                        @change="chekParent(index)"
                                    >
                                    </v-checkbox>
                                    </v-list-item-action>

                                    <v-list-item-action>
                                    <v-btn
                                        icon
                                        @click="show(index)"
                                    >
                                        <v-icon>{{menu.show ? 'mdi-chevron-up' : 'mdi-chevron-down'}}</v-icon>
                                    </v-btn>
                                    </v-list-item-action>
                                </v-list-item>
                                <v-divider></v-divider>
                                <v-card-text v-if="menu.show && menu.child.length > 0">
                                    <v-list-item v-for="(child,i) in menu.child" :key="i">
                                        <v-list-item-content>
                                            <v-list-item-title>{{child.description}}</v-list-item-title>
                                        </v-list-item-content>
                                        <v-list-item-action>
                                        <v-checkbox
                                            v-model="child.checkbox"
                                            @change="chekChild(index,i)"
                                        >
                                        </v-checkbox>
                                        </v-list-item-action>
                                    </v-list-item>
                                    <v-divider></v-divider>

                                </v-card-text>
                            </v-card>
                        </v-card-text>
                    </v-card>
                </v-card-text>

            </v-card>
        </v-container>
    </v-app>

</template>
<script>

import {mapActions} from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    data: () => ({
        menus:[],
        parentMenu:[],
        role:'',
        childMenu:[],
        checkbox:false,
        loading:false
    }),

    methods: {
        ...mapActions({
             setSnakbar: 'snakbar/setSnakbar',
             setAuth : 'auth/setAuth'
        }),
        show(index){
            let menu = this.menus.find((item,i) => i === index)
            menu.show = menu.show == false ? true : false
            this.menus.splice(index,1,menu)
        },

        chekParent(index){
            let menu = this.menus.find((item,i)  => i === index)

            // console.log(menu)
            if (menu.checkbox === false) {
                let idParent = this.parentMenu.indexOf(menu.id)
                this.parentMenu.splice(idParent,1)
                // console.log(this.parentMenu)
            }else{
                this.parentMenu.push(menu.id)
                // console.log(this.parentMenu)
            }
        },

        chekChild(indexParent,indexChild){
            let menu = this.menus.find((item,i)  => i === indexParent)
            let child = menu.child.find((item,i) => i === indexChild)
            if (child.checkbox === false) {
                let idChild = this.childMenu.indexOf(child.id)
                this.childMenu.splice(idChild,1)
            }else{
                this.childMenu.push(child.id)
            }
        },

        async save(){
            this.loading = true
            let url = window.location.pathname
            url = url.split('/')
            let data = new FormData()
            data.append('id_role', url[2])
            data.append('parent_menu',JSON.stringify(this.parentMenu))
            data.append('child_menu',JSON.stringify(this.childMenu))
            url = url[1]

            await this.axios.post(url,data,this.config)
            .then((ress) => {
                // console.log(ress)
                this.setSnakbar({
                    pesan:ress.data.message,
                    color:'success',
                    status : true,
                })
                this.me()
            })
            .catch((err) => {
                console.log(err.response)
            })

            this.loading =false
        },

        me(){
            this.axios.get('/me',this.config)
            .then((ress) => {
                this.setAuth({
                    menu:ress.data.menu,
                    user:ress.data.user,
                    token:ress.data.access_token
                })
            })
            .catch((err) =>console.log(err.response))
        },

        chekAll(){
            this.parentMenu=[]
            this.childMenu= []
            this.menus.forEach(data => {
                data.checkbox = this.checkbox ? true : false
                if (this.checkbox) this.parentMenu.push(data.id)
                data.child.forEach(datas => {
                    datas.checkbox = this.checkbox ? true : false
                    if(this.checkbox) this.childMenu.push(datas.id)
                })
            })

            // console.log(this.parentMenu)
            // console.log(this.childMenu)
        },

        go(){
            let url = window.location.pathname
            this.axios.get(url,this.config)
            .then((ress) => {
                console.log(ress)
                this.parentMenu = ress.data.role_menu ? ress.data.role_menu.parent : []
                this.childMenu = ress.data.role_menu ? ress.data.role_menu.child : []
                this.role = ress.data.role
                ress.data.menu.forEach(data => {
                    let child = []
                    let checkbox =this.parentMenu.find((item) => item === data.id) ? true : false
                    if (data.status_child === 1 ) {
                        data.child_menu.forEach(datas => {
                            let checkbox_child = this.childMenu.find((item) => item === datas.id) ? true : false
                            child.push({
                                id:datas.id,
                                description:datas.description,
                                checkbox:checkbox_child
                            })
                        })
                    }
                    let menu = {
                        description: data.description,
                        id: data.id,
                        show:true,
                        child:child,
                        checkbox: checkbox
                    }
                    this.menus.push(menu)
            });
        })
        .catch((err) => {
            console.log(err.response)
        })
        }
    },

    created(){
        this.go()
    },

    mixins:[middleware]
}
</script>
