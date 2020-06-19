export default  {
    path: '/gratifikasi',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'gratifikasi.index',
            component:()=>import('../views/gratifikasi/index.vue'),
        },
        // {
        //     path:'create',
        //     name:'gratifikasi.create',
        //     component:()=>import('../views/gratifikasi/create.vue')
        // },
        {
            path:':id/edit',
            name:'gratifikasi.edit',
            component:()=>import('../views/gratifikasi/edit.vue')
        },
    ]
}
