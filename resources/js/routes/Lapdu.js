export default  {
    path: '/e-lapdu',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'lapdu.index',
            component:()=>import('../views/lapdu/index.vue'),
        },
        // {
        //     path:'create',
        //     name:'lapdu.create',
        //     component:()=>import('../views/lapdu/create.vue')
        // },
        // {
        //     path:':id/edit',
        //     name:'lapdu.edit',
        //     component:()=>import('../views/lapdu/edit.vue')
        // },
    ]
}
