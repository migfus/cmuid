import { createRouter, createWebHistory, isNavigationFailure, NavigationFailureType } from "vue-router"
import { useAuthStore } from "@/store/@auth/AuthStore"
import { usePreLoader } from "@/store/system/PreLoader"
import ability from '@/Ability'

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
          path: '/request',
          name: 'request-list',
          component: () => import('@/views/dashboard/request.vue'),
          meta: {
            title: 'Requesting ID',
            sideBar: true
          }
        },
        {
          path: '/completed',
          name: 'completed',
          component: () => import('@/views/dashboard/completed.vue'),
          meta: {
            title: 'Completed',
            sideBar: true
          }
        },
        {
          path: '/canceled',
          name: 'canceled',
          component: () => import('@/views/dashboard/canceled.vue'),
          meta: {
            title: 'Canceled',
            sideBar: true
          }
        },
        {
          path: '/claimed',
          name: 'claimed',
          component: () => import('@/views/dashboard/claimed.vue'),
          meta: {
            title: 'Claimed',
            sideBar: true
          }
        },
        {
          path: '/upload',
          name: 'upload',
          component: () => import('@/views/dashboard/upload/index.vue'),
          meta: {
            title: 'Upload',
            sideBar: true
          }
        },
        {
          path: '/uploaded',
          name: 'uploaded',
          component: () => import('@/views/dashboard/upload/index.vue'),
          meta: {
            title: 'Uploaded',
            sideBar: true
          }
        },
        {
          path: '/devices',
          name: 'devices',
          component: () => import('@/views/dashboard/devices.vue'),
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
  const $auth = useAuthStore()

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

  // const $auth = useAuthStore();

  // if ($auth.token == "" && to.name !== "login") {
  //   return { name: "login" };
  // }

  // if(to.meta.auth && $auth.token == '' && to.meta.name != 'login') {
  //   return { name: 'login'};
  //   // return false
  // }

  // if(to.meta.role) {
  //   if($auth.content.auth.role == 2) {

  //   }
  //   else if(to.meta.role != $auth.content.auth.role && to.meta.name != 'error') {
  //     // return { name: 'error'}
  //     return false
  //   }
  // }
  if(!canNavigate) {
    next(new Error('Route Disabled (no permission)'))
  }

  next()
});

router.afterEach((to, from, failure) => {

  const $load = usePreLoader()
  $load.config.loading = false

  document.title = to.meta.title ? `${to.meta.title} | ${TITLE}` : "";
})

export default router;
