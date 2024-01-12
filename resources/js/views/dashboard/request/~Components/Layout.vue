<template>
  <div>
    <main class="relative">
      <div class="mx-auto max-w-screen-xl pb-6">
        <div class="overflow-hidden">
          <div class="lg:grid lg:grid-cols-12 gap-3">
            <aside class="py-6 lg:col-span-3 sm:rounded-xl bg-white shadow mb-2">
              <nav class="space-y-1">

                <RouterLink :to="{name: 'request-list'}" @click="ScrollUp()" :class="['request-list' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <UserPlusIcon :class="['requesting-list' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{ namingFormat($number.content.requesting) }} Requesting</span>
                </RouterLink>

                <RouterLink :to="{name: 'completed'}" @click="ScrollUp()" :class="['completed' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <CheckCircleIcon :class="['completed' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{  namingFormat($number.content.completed) }} Completed</span>
                </RouterLink>

                <RouterLink :to="{name: 'canceled'}" @click="ScrollUp()" :class="['canceled' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <XCircleIcon :class="['canceled' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{  namingFormat($number.content.canceled) }} Canceled</span>
                </RouterLink>

                <RouterLink :to="{name: 'claimed'}" @click="ScrollUp()" :class="['claimed' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <ArchiveBoxArrowDownIcon :class="['claimed' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{  namingFormat($number.content.claimed) }} Claimed</span>
                </RouterLink>

              </nav>
            </aside>

            <slot></slot>


          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useRequestNumberStore } from '@/store/@admin/RequestNumberStore'

import { CheckCircleIcon, UserPlusIcon, XCircleIcon, ArchiveBoxArrowDownIcon,  } from '@heroicons/vue/24/outline'

const $route = useRoute()
const $number = useRequestNumberStore()

function namingFormat(num: number) {
  if(num > 1) {
    return `${num} are `
  }
  else if(num == 1) {
    return `${num} is `
  }
  return `0`
}

function ScrollUp() {
  let w = window.innerWidth;

  window.scrollTo({
    top: w < 1024 ? 800 : 0,
    behavior: 'smooth'
  })
}

onMounted(() => {
  $number.GetAPI()
})
</script>
