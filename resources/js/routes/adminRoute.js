import blog from "@/views/admin/blog/route"
import project from "@/views/admin/project/route"
import Gallery from "@/views/admin/projectgallery/route"
import Settings from "@/views/admin/settings/route"

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
            ...project,
            ...Gallery,
            ...Settings
        ]
    },
]