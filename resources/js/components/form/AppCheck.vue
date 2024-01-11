<template>
  <div class="flex h-5 items-center">
    <input
      v-model="$model"
      :name="$props.name"
      :id="$props.name"
      type="checkbox"
      class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500"
    />
  </div>
  <div class="ml-3 text-sm">
    <label for="comments" class="font-medium text-gray-700">{{ $props.placeholder }}</label>
    <p v-if="$props.desc" class="text-gray-500">{{ $props.desc }}</p>
  </div>
  <ErrorMessage :name="$props.name" class="text-sm font-medium text-red-500"/>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Field, ErrorMessage } from 'vee-validate'

const $props = defineProps<{
  placeholder: string
  name: string
  errors?: any
  desc?: string
}>()
const $model = defineModel()

const error = computed(() => {
  if($props.errors) {
    if($props.errors[$props.name]) {
      return $props.errors[$props.name]
    }
  }
  return null
})
</script>
