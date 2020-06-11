export default  {
    path:'/menu',
    component:() => import('../views/index.vue'),
    meta:{auth:true},
    children:[
        {
            path:'',
            name:'menu.index',
            component:() => import('../views/menu/index.vue')
        },
        {
            path:'create',
            name:'menu.create',
            component:()=> import('../views/menu/create.vue')
        },
        {
            path:':id/edit',
            name:'menu.edit',
            component:()=>import('../views/menu/edit.vue')
        }
    ]
}
