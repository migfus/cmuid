<template>
  <div class="max-w-7xl mx-auto my-4 grid grid-cols-6 gap-4">
    <InformationCard class="col-span-6 md:col-span-3"/>
    <StatusCard class="col-span-6 md:col-span-3"/>
  </div>
</template>

<script setup lang="ts">
import StatusCard from './~Components/StatusCard.vue'
import InformationCard from './~Components/InformationCard.vue'
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useStatusPublicStore } from '@/store/public/StatusPublicStore'

const $route = useRoute()
const $status = useStatusPublicStore()

onMounted(() => {
  // @ts-ignore
  $status.ShowAPI($route.params.id)
})
</script>
