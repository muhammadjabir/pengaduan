export default  {
    path: '/wbs',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'wbs.index',
            component:()=>import('../views/wbs/index.vue'),
        },
        // {
        //     path:'create',
        //     name:'wbs.create',
        //     component:()=>import('../views/wbs/create.vue')
        // },
        {
            path:':id/edit',
            name:'wbs.edit',
            component:()=>import('../views/wbs/edit.vue')
        },
    ]
}
