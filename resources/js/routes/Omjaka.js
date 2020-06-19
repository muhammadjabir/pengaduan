export default  {
    path: '/omjaka',
    component:()=>import('../views/index.vue'),
    meta:{auth:true},

    children: [
        {
            path: '',
            name: 'omjaka.index',
            component:()=>import('../views/omjaka/index.vue'),
        },
        // {
        //     path:'create',
        //     name:'omjaka.create',
        //     component:()=>import('../views/omjaka/create.vue')
        // },
        {
            path:':id/edit',
            name:'omjaka.edit',
            component:()=>import('../views/omjaka/edit.vue')
        },
    ]
}
