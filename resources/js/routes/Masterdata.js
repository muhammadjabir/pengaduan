export default  {
    path: '/masterdata',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'masterdata.index',
            component:()=>import('../views/masterdata/index.vue'),
        },
        {
            path:'create',
            name:'masterdata.create',
            component:()=>import('../views/masterdata/create.vue')
        },
        {
            path:':id/edit',
            name:'masterdata.edit',
            component:()=>import('../views/masterdata/edit.vue')
        },
    ]
}
