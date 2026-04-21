import blog from "@/views/admin/blog/route"

export default [
    {
        path: "/admin",
        component: () => import('@/views/admin/layout/index.vue'),
        children: [
            {
                path: 'dashboard', 
                name: 'dashboard',
                component: () => import('@/views/admin/Overview.vue'),
            },
            ...blog, 
        ]
    },
]