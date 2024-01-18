<template>
  <BasicTransition>
    <div class="bg-white rounded-xl mb-3 shadow py-4 flex justify-between px-4">
      <div class="font-medium text-lg text-gray-600 mt-1">
        SMS Devices
      </div>
      <div class="flex gap-2">
        <a href="/assets/OHRM SMS 0.0.3.apk" target="_blank">
          <AppButton class="inline">Download Android App</AppButton>
        </a>
        <AppButton @click="show = true" class="inline">Add Device</AppButton>
      </div>
    </div>
  </BasicTransition>

  <DataTransition>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
      <div v-for="row in $device.content" :key="row.id" class="overflow-hidden bg-white shadow sm:rounded-xl">
        <ul role="list" class="divide-y divide-gray-200 rounded-xl">
          <DeviceData :id="row.id" :name="row.name" :platform="row.platform" :last_response="row.last_response"/>
        </ul>
      </div>
    </div>
  </DataTransition>

  <PromptModal @confirm="$device.PostAPI" title="Add Device?" confirmButtonName="Confirm" v-model="show">
    <p>Do you want to add another device?</p>
  </PromptModal>
</template>

<script setup lang="ts">
import { useDeviceDashboardStore } from '@/store/dashboard/DeviceDashboardStore'
import { onMounted, ref, onUnmounted } from 'vue'

import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import DeviceData from './~Components/DeviceData.vue'
import AppButton from '@/components/form/AppButton.vue'
import PromptModal from '@/components/modals/PromptModal.vue'

const $device = useDeviceDashboardStore()

const show = ref(false)
let myTimer;

onMounted(() => {
  $device.GetAPI()

  myTimer = setInterval(() => {
    $device.GetAPI()
  }, 10000)
})

onUnmounted(() => {
  clearInterval(myTimer)
})
</script>
