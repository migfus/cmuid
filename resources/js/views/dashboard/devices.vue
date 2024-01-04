<template>
  <BasicTransition>
    <div class="flex justify-center">
      <div class="bg-white rounded-xl shadow p-4 grid justify-center mb-4 max-w-md">
        <div>
          <img :src="qrcode">
        </div>
        <div>
          <h2 class="mb-2">Scan to add new device.</h2>
        </div>
      </div>
    </div>
  </BasicTransition>

  <DataTransition>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
      <div v-for="row in $device.content" :key="row.id" class="overflow-hidden bg-white shadow sm:rounded-xl">
        <ul role="list" class="divide-y divide-gray-200 rounded-xl">
          <h1 class="p-4 font-bold text-gray-500">Devices</h1>
            <DeviceData :id="row.id" :name="row.name" :platform="row.platform" :last_response="row.last_response"/>
        </ul>
      </div>
    </div>
  </DataTransition>

</template>

<script setup lang="ts">
import { useDeviceStore } from '@/store/@admin/DeviceStore'
import { onMounted, ref, onUnmounted } from 'vue'

import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import DeviceData from './~Components/DeviceData.vue'
import { useQRCode } from '@vueuse/integrations/useQRCode'
import { idGenerator } from '@/helpers/Converter'

const $device = useDeviceStore()
const qrRaw = ref(
  JSON.stringify({
    id: 'security-key?',
    link: window.location.origin
  })
)

const qrcode = ref(useQRCode(qrRaw.value))
let myTimer;

onMounted(() => {
  $device.GetAPI()

  myTimer = setInterval(() => {
    $device.params.id = idGenerator()

    $device.GetAPI()
  }, 10000)
})

onUnmounted(() => {
  clearInterval(myTimer)
})
</script>
