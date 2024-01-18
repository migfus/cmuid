<template>
  <div class="max-w-7xl mx-auto">
    <StatCards />
    <div class="grid grid-cols-12 mt-4 gap-3">
      <div class="col-span-12 sm:col-span-8">

        <RequestCard />

      </div>
      <div class="col-span-12 lg:col-span-4">
        <DeviceList></DeviceList>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import StatCards from './~Components/StatCards.vue'
import DeviceList from './~Components/DeviceList.vue'
import RequestCard from './~Components/RequestCard.vue'
</script>
