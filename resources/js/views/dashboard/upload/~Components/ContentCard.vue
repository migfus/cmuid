<template>
  <h2 class="bg-white mb-3 sm:rounded-xl p-5 shadow font-bold text-gray-600 grid grid-cols-12">
    <div class="col-span-6 mt-1">
      {{ $props.title }}
    </div>
    <div class="col-span-6">
      <slot name="search"></slot>
    </div>
  </h2>

  <div class="sm:p-0 lg:pb-8">

    <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
      <ul role="list" class="divide-y divide-gray-200">
        <slot></slot>
      </ul>
    </div>

  </div>
</template>

<script setup lang="ts">

const $props = defineProps<{
  title: string
  config: {
    form?: string
    buttonLoading: boolean
    contentLoading: boolean
  }
}>()
const $emit = defineEmits(['actionCreateClick', 'actionCancelClick'])
const $model = defineModel()
</script>
