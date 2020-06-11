import Vue from 'vue'
import Vuex from 'vuex'
// import auth from './stores/auth'
import snakbar from './stores/Snakbar'
import auth from './stores/Auth'
import BeforeUrl from './stores/BeforeUrl'
import dialog from './stores/Dialog'
// import statusDialog from './stores/dialog'
// import aplication from './stores/aplication'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        sideBar:true,
    },
    mutations: {
        setSidebar: (state,status) => {
            state.sideBar=status
        }
    },
    actions: {
        setSidebar: ({commit},status)=>{
            commit('setSidebar',status)
        }
    },
    getters: {
        sideBar: state => state.sideBar,
    },
    modules:{
        auth,
        snakbar,
        BeforeUrl,
        dialog
        // statusDialog,
        // aplication,
    }
  })
