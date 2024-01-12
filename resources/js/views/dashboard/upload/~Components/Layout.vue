<template>
  <div>
    <main class="relative">
      <div class="mx-auto max-w-screen-xl pb-6">
        <div class="overflow-hidden">
          <div class="lg:grid lg:grid-cols-12 gap-3">
            <aside class="py-6 lg:col-span-3 sm:rounded-xl bg-white shadow mb-2">
              <nav class="space-y-1">
                <RouterLink :to="{name: 'upload'}" @click="ScrollUp()" :class="['upload' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <QuestionMarkCircleIcon :class="['upload' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">Upload Soft Copy</span>
                  <span v-if="$number.content.upload" class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 ml-2">{{  $number.content.requesting }}</span>
                </RouterLink>

                <RouterLink :to="{name: 'uploaded'}" @click="ScrollUp()" :class="['uploaded' == $route.name ? 'bg-teal-50 border-teal-500 text-teal-700 hover:bg-teal-50 hover:text-teal-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium']" :aria-current="true ? 'page' : undefined">
                  <CheckCircleIcon :class="['uploaded' == $route.name ? 'text-teal-500 group-hover:text-teal-500' : 'text-gray-400 group-hover:text-gray-500', 'flex-shrink-0 -ml-1 mr-3 h-6 w-6']" aria-hidden="true" />
                  <span class="truncate">Uploaded</span>
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
import { CheckCircleIcon, QuestionMarkCircleIcon } from '@heroicons/vue/24/outline'
import { useRequestNumberStore } from '@/store/@admin/RequestNumberStore'

const $route = useRoute()
const $number = useRequestNumberStore()

function ScrollUp() {
  let w = window.innerWidth;

  window.scrollTo({
    top: w < 1024 ? 800 : 0,
    behavior: 'smooth'
  })
}
</script>
