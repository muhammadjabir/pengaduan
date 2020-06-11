<template>
	<nav>
		<v-app-bar app color="teal darken-2" class="white--text" v-if="user" >
		    <v-app-bar-nav-icon color="white"
		    @click="sideBar()"></v-app-bar-nav-icon>
		    <v-toolbar-title>Mode Developer</v-toolbar-title>
		    <v-spacer></v-spacer>

		      <v-btn class="white--text" text @click="logOut"  >Logout</v-btn>

		  </v-app-bar>
	</nav>

</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import middleware from '../../mixins/middleware'
export default {
    name:'navbar',
    methods:{
        ...mapActions({
            setSidebar : 'setSidebar',
            setAuth : 'auth/setAuth'
        }),
        sideBar(){
            this.setSidebar(!this.sidebar)
        },
        async logOut(){
            await this.axios.post('/logout',{},this.config)
            .then((ress) => {
                this.setAuth({
                    user:null,
                    token:null,
                    menu:null
                })

                localStorage.removeItem('token')

                this.$router.push('/login')
            })
            .catch((err) =>console.log(err))
        }
    },

    mixins:[middleware],
    computed: {
        ...mapGetters({
            sidebar: 'sideBar',
            // token: 'auth/token',
            user : 'auth/user'
        })
    },
}
</script>
