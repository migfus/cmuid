<template>
  <div>
    <main class="relative">
      <div class="mx-auto max-w-screen-xl pb-6">
        <div class="overflow-hidden">
          <div class="lg:grid lg:grid-cols-12 gap-3">
            <aside class="py-6 lg:col-span-3 sm:rounded-xl bg-white shadow mb-2">
              <nav class="space-y-1">
                <RouterLink v-for="item in subNavigation" :key="item.name" :to="{name: item.href}" @click="ScrollUp()" :class="[item.href == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="item.current ? 'page' : undefined">
                  <component :is="item.icon" :class="[item.href == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">{{ item.name }}</span>
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
import {useRoute} from 'vue-router'
import { CheckCircleIcon, UserPlusIcon, XCircleIcon, ArchiveBoxArrowDownIcon } from '@heroicons/vue/24/outline'

const $route = useRoute()

const subNavigation = [
  { name: 'Requesting', href: 'request-list', icon: UserPlusIcon , current: true },
  { name: 'Completed', href: 'completed', icon: CheckCircleIcon , current: false },
  { name: 'Canceled', href: 'canceled', icon: XCircleIcon , current: false },
  { name: 'Claimed', href: 'claimed', icon: ArchiveBoxArrowDownIcon , current: false },
]

function ScrollUp() {
  let w = window.innerWidth;

  window.scrollTo({
    top: w < 1024 ? 800 : 0,
    behavior: 'smooth'
  })
}
</script>
