export default {
        path:'/users',
        component:() => import('../views/index.vue'),
        meta:{auth:true},
        children:[
            {
                path:'',
                name:'users.index',
                component : () => import('../views/user-management/index.vue')
            },
            {
                path:'create',
                name:'users.create',
                component : () => import('../views/user-management/create.vue')
            },
            {
                path:':id/edit',
                name:'users.edit',
                component: () => import('../views/user-management/edit.vue')
            }

        ]
    }

