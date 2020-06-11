export default {
    path:'/role-management',
    component: () => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name: 'rolemanagement.index',
            component:()=> import('../views/role-management/index.vue')
        },
        {
            path:':id/edit',
            name:'rolemanagement.edit',
            component:()=>import('../views/role-management/edit.vue')
        }

    ]
}
