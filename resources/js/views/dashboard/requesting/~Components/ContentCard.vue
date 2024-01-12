<template>
  <h2 class="bg-white mb-3 sm:rounded-xl p-5 shadow font-bold text-gray-600 grid grid-cols-12">
    <div class="col-span-6 mt-1 header-title">
      {{ $props.data.query.filter }}
    </div>
    <div class="col-span-6">
      <AppInput v-model="$props.data.query.search" name="search" placeholder="Search" noLabel/>
    </div>
  </h2>

  <div class="sm:p-0">
    <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
      <ul role="list" class="divide-y divide-gray-200">
        <slot></slot>
      </ul>
    </div>
  </div>

  <div v-if="$props.data.content.total > 10" class="flex justify-end bg-white p-4 rounded-xl shadow mb-2">
    <TailwindPagination
      :data="$props.data.content"
      @pagination-change-page="$props.data.GetAPI"
      activeClasses="bg-gray-300"
      itemClasses="shadow border-0"
    />
  </div>

</template>

<script setup lang="ts">
import { watch } from 'vue'
import { useDebounceFn } from '@vueuse/core'

import AppInput from '@/components/form/AppInput.vue'
import { TailwindPagination } from 'laravel-vue-pagination'

const $props = defineProps<{
  data: any
}>()

watch($props.data.query, useDebounceFn(() => {
  $props.data.GetAPI()
}, 1000))
</script>

<style scoped>
.header-title {
  text-transform:capitalize;
}
</style>
