<template>
    <div width="600px">
    <v-container>
        <v-card>
            <v-row
            justify="center"
            align="center"
            >
                <v-col
                class="d-none d-sm-inline-block col-6"
                >
                    <img src="http://birokrasi.id/storage/login.png" width="100%" alt="">
                </v-col>

                <v-col
                class="col-12 col-sm-6"
                >
                <v-container>
                    <h3>Login</h3>

                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation
                    >
                        <!-- <v-text-field
                        v-model="name"
                        :counter="10"
                        :rules="nameRules"
                        label="Name"
                        required
                        ></v-text-field> -->

                        <v-text-field
                        v-model="email"
                        :rules="emailRules"
                        label="E-mail"
                        required
                        ></v-text-field>
                        <v-text-field
                        v-model="password"
                        :rules="nameRules"
                        type="password"
                        label="password"
                        required
                        ></v-text-field>
                        <br>
                        <v-btn
                        :disabled="!valid"
                        color="pink accent-3"
                        class="mr-4 white--text"
                        rounded
                        block
                        :loading="loading"
                        @click="login"
                        >
                        Log-in
                        </v-btn>
                    </v-form>
                </v-container>

                </v-col>
            </v-row>
        </v-card>

    </v-container>

    </div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex'
import store from '../stores'
import axios from 'axios'

export default {
    name: 'Login',
     data: () => ({
      valid: false,
      password: '',
      nameRules: [
        v => !!v || 'Password is required',

      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      loading:false
    }),

    methods : {
        ...mapActions({
            setAuth:'auth/setAuth',
            setSnakbar:'snakbar/setSnakbar'
        }),

        async login(){
            this.loading = true
            let data = new FormData()
            data.append('email',this.email)
            data.append('password',this.password)
            await this.axios.post('/login',data)
            .then((ress) => {
                console.log(ress)
                this.setAuth({
                    user: ress.data.user,
                    token : ress.data.access_token,
                    menu : ress.data.menu
                })
                localStorage.setItem('token', this.token);
                this.$router.push('/dahsboard')
            })
            .catch((err) =>{
                this.setSnakbar({
                    color:'red',
                    pesan : 'Email atau Password salah',
                    status : true
                })
            })
            this.loading = false

        }
    },
    computed: {
        ...mapGetters({
            user:'auth/user',
            menu: 'auth/menu',
            token : 'auth/token',
            beforeUrl : 'BeforeUrl/url'
        })
    },
    async beforeRouteEnter(to, from, next){
        // console.log(to)
        // console.log(from)
        // console.log(next)
        let token = localStorage.getItem('token')

        console.log(token)
        let config = {
            headers: {
            'Authorization': 'Bearer ' + token,
            }
        }
        if (token) {
        await axios.get('/api/me',config)
            .then((ress) =>{
                store.dispatch('auth/setAuth',{
                    user: ress.data.user,
                    token : ress.data.access_token,
                    menu : ress.data.menu
                })
                next('login')
            }
                )
            .catch((err) =>console.log(err))
        }
        next()
    },
//    async beforeMount(){
//        let token = localStorage.token
//        if (token) {
//            let config = {
//                 headers: {
//                 'Authorization': 'Bearer ' + token,
//                 }
//             }
//             await this.axios.get('/me',config)
//                 .then((ress) =>{
//                     console.log(ress.data)
//                 }
//                     )
//                 .catch((err) =>console.log(err))
//        }
//     }

}
</script>

<style>

</style>
