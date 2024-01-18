<template>
  <div class="max-w-7xl mx-auto my-4 grid grid-cols-6 gap-4">
    <InformationCard class="col-span-6"/>
  </div>

</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useVerifyPublicStore } from '@/store/public/VerifyPublicStore'

import InformationCard from './~Components/InformationCard.vue'

const $route = useRoute()
const $verify = useVerifyPublicStore()

onMounted(() => {
  // @ts-ignore
  $verify.ShowAPI($route.params.id)
})
</script>
