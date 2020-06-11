export default  {
    path: '/kategori',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'kategori.index',
            component:()=>import('../views/kategori/index.vue'),
        },
        {
            path:'create',
            name:'kategori.create',
            component:()=>import('../views/kategori/create.vue')
        },
        {
            path:':id/edit',
            name:'kategori.edit',
            component:()=>import('../views/kategori/edit.vue')
        },
    ]
}
