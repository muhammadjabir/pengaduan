export default  {
    path: '/pengaduan',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'pengaduan.index',
            component:()=>import('../views/pengaduan/index.vue'),
        },
        // {
        //     path:'create',
        //     name:'pengaduan.create',
        //     component:()=>import('../views/pengaduan/create.vue')
        // },
        {
            path:':id/edit',
            name:'pengaduan.edit',
            component:()=>import('../views/pengaduan/edit.vue')
        },
    ]
}
