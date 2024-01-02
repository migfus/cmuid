<template>
  <select
    v-model="$model"
    class="block w-full rounded-md border-gray-300 shadow focus:border-gray-300 focus:ring-gray-300 sm:text-sm"
  >
    <slot>
    </slot>
  </select>
</template>

<script setup lang="ts">
import { toRefs } from 'vue'

const $props = defineProps({
  placeholder:{
    default: '',
    type: String,
  },
})
const $model = defineModel<string>();

const { placeholder } = toRefs($props)

</script>
