<template>
  <RequestForm title="Claimed"/>

  <InfoCard />
</template>

<script setup lang="ts">
import { useRequestStore } from '@/store/@admin/RequestStore'
import { onMounted } from 'vue'

import InfoCard from './~Components/InfoCard.vue'
import RequestForm from './~Components/RequestForm.vue'

const $request = useRequestStore()

onMounted(() => {
  $request.query.filter = 'claimed'
  $request.GetAPI()
})
</script>
