<template>
  <label
    v-if="!noLabel"
    :for="$props.name"
    :class="[
      'block text-sm font-medium text-gray-700',
      error && 'text-red-500'
    ]"
  >
    {{ $props.placeholder }}
  </label>
  <Field
    @input="$emit('update:modelValue', $event.target.value)"
    v-model="$model"
    :placeholder="$props.placeholder"
    :type="$props.type"
    :name="$props.name"
    :id="$props.name"
    as="textarea"
    rows="6"
    :class="[
      'mt-1 block w-full rounded-xl border border-gray-300 py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm',
      error && 'border-red-500 focus:border-red-400 focus:ring-red-400',
      ltr && 'text-right'
    ]"
  />
  <ErrorMessage :name="$props.name" class="text-sm font-medium text-red-500"/>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Field, ErrorMessage } from 'vee-validate'

const $props = defineProps<{
  placeholder: string
  name: string
  type?: string
  errors?: any
  noLabel?: boolean
  ltr?: boolean
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
