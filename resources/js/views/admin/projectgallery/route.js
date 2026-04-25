import index from './index.vue'

export default [
    {
        path: "gallery/:id",
        children: [  
            { path: '', component: index },
        ],
    },
]