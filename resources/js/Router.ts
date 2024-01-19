import { createRouter, createWebHistory } from "vue-router"
import { useAuthPublicStore } from "@/store/public/AuthPublicStore"
import { usePreLoader } from "@/store/system/PreLoader"
import ability from '@/Ability'
import { useTitle } from '@vueuse/core'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    // NOTE PAGES
    {
      path: "/",
      children: [
        {
          path: '',
          name: 'request',
          component: () => import('@/views/request/index.vue'),
          meta: {
            title: 'Request for CSC-ID',
          }
        },
        {
          path: '/confirm',
          name: 'confirm-request',
          component: () => import('@/views/request/confirm.vue'),
          meta: {
            title: 'Confirm Request',
          }
        },
        {
          path: 'status',
          name: 'status',
          component: () => import('@/views/status/index.vue'),
          meta: {
            title: 'CSC ID Status',
          }
        },
        {
          path: 'status/:id',
          name: 'status-show',
          component: () => import('@/views/status/[id].vue'),
          meta: {
            title: 'CSC ID Status',
          }
        },
        {
          path: 'verify',
          name: 'verify',
          component: () => import('@/views/verify/index.vue'),
          meta: {
            title: 'Verify ID',
          }
        },
        {
          path: 'verify/:id',
          name: 'verify-show',
          component: () => import('@/views/verify/[id].vue'),
          meta: {
            title: 'Verify CSC ID',
          }
        }
      ]
    },

    {
      path: '/dashboard',
      children: [
        {
          path: '',
          name: 'dashboard',
          component: () => import('@/views/dashboard/index.vue'),
          meta: {
            title: 'Dashboard',
            sideBar: true
          }
        },
        {
          path: 'requesting',
          children: [
            {
              path: '',
              name: 'requesting',
              component: () => import('@/views/dashboard/requesting/index.vue'),
              meta: {
                title: 'Requesting',
                sideBar: true
              },
            },
            {
              path: 'completed',
              name: 'completed',
              component: () => import('@/views/dashboard/requesting/completed.vue'),
              meta: {
                title: 'Completed',
                sideBar: true
              },
            },
            {
              path: 'canceled',
              name: 'canceled',
              component: () => import('@/views/dashboard/requesting/canceled.vue'),
              meta: {
                title: 'Canceled',
                sideBar: true
              }
            },
            {
              path: 'claimed',
              name: 'claimed',
              component: () => import('@/views/dashboard/requesting/claimed.vue'),
              meta: {
                title: 'Claimed',
                sideBar: true
              }
            },
          ]

        },

        {
          path: 'upload',
          children: [
            {
              path: '',
              name: 'upload',
              component: () => import('@/views/dashboard/upload/index.vue'),
              meta: {
                title: 'Upload',
                sideBar: true
              }
            },
            {
              path: 'uploaded',
              name: 'uploaded',
              component: () => import('@/views/dashboard/upload/uploaded.vue'),
              meta: {
                title: 'Uploaded',
                sideBar: true
              }
            },
          ]

        },
        {
          path: '/devices',
          name: 'devices',
          component: () => import('@/views/dashboard/devices/index.vue'),
          meta: {
            title: 'Devices',
            sideBar: true
          }
        },
      ]
    },

    {
      path: "/login",
      children: [
        {
          name: 'login',
          path: '',
          component: () => import('@/views/login/index.vue'),
          meta: {
            title: 'Login',
          }
        },
      ]

    },

    // NOTE OTHER
    {
      path: "/:pathMatch(.*)*",
      name: 'error',
      component: () => import("@/views/[error].vue"),
      meta: {
        title: "Page not Found!",
      },
    },
  ],
});


const TITLE = "CMU OHRM ID"
router.beforeEach(async (to, from, next) => {
  const $load = usePreLoader()
  const $auth = useAuthPublicStore()

  $load.config.loading = true
  $load.config.to = to.name

  $auth.UpdateAbility()

  const canNavigate = to.matched.some(row => {
    if(row.meta.resource) {
      // @ts-ignore
      return ability.can(row.meta.action || 'index', row.meta.resource)
    }
    return true;
  })

  if(!canNavigate) {
    next(new Error('Route Disabled (no permission)'))
  }

  next()
});

router.afterEach((to, from, failure) => {
  const $load = usePreLoader()
  $load.config.loading = false

  const title = useTitle()

  title.value = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
})

export default router;
