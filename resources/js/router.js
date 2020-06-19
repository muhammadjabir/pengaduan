import Vue from 'vue'
import Router from 'vue-router'
import store from './stores'
import axios from 'axios'

import UserRouter from './routes/users'
import MasterDataRouter from './routes/Masterdata'
import MenuRouter from './routes/Menu'
import RoleManagementRouter from './routes/RoleManagement'
import KategoriRouter from './routes/Kategori'
import PengaduanRouter from './routes/Pengaduan'
import LapduRouter from './routes/Lapdu'
import OmjakaRouter from './routes/Omjaka'
import WbsRouter from './routes/Wbs'
<<<<<<< HEAD
=======
import GratifikasiRouter from './routes/Gratifikasi'
>>>>>>> 6c11c0e650f0bf86a27eec607e2d1528765c56b1

// import Vuetify from 'vuetify'
// Vue.use(Vuetify)
import './plugins/vuetify.js'
Vue.use(Router)
const router = new Router({
  mode: 'history',
  routes: [
    {
        path:'',
        name:'index',
        component:()=>import('./views/index.vue'),
        children:[
            {
                path: '/dahsboard',
                name: 'dashboard',
                component:()=>import('./views/index.vue'),
                meta:{auth:true}

            },

            UserRouter,
            MasterDataRouter,
            MenuRouter,
            RoleManagementRouter,
            KategoriRouter,
            PengaduanRouter,
            LapduRouter,
            OmjakaRouter,
<<<<<<< HEAD
            WbsRouter
=======
            WbsRouter,
            GratifikasiRouter
>>>>>>> 6c11c0e650f0bf86a27eec607e2d1528765c56b1

        ]

    },

    {
        path: '/login',
        name: 'login',
        component:()=>import('./views/Login.vue')
    },
    {
        path: '/404',
        name: 'notfound',
    },

    {
      path: '*',
      redirect: {
        name: 'notfound'
      }
    },

  ]
})



router.beforeEach(async (to,from,next) => {
    if( to.name != 'login') store.dispatch('BeforeUrl/setUrl',to.path)
    if (to.matched.some(record => record.meta.auth)) {

        if (store.getters['auth/user']) {
            next()
        }else{
            next('/login')
        }
    }else if(to.name == 'login'){
        if (!store.getters['auth/user']) {
            next()
        }else{
            router.push(store.getters['BeforeUrl/url'])

        }
    }else{
        next()
    }
})
// router.beforeEach((to,from,next) =>{
//     if(to.matched.some(record => record.meta.auth)){
//         //cek jika ada users maka kehalaman yg di tuju
//         if (store.getters['auth/user']) {
//             next()
//         }else{
//             next('/login')
//         }
//     }else if(to.name == 'login'){
//         //cek jika tidak ada users maka kehalaman login
//         if (!store.getters['auth/user']) {
//             next()
//         }else{

//             next('/dashboard')
//         }
//     }
//     else{
//         next()
//     }
// })
export default router
