<template>
  <main class="relative">
    <div class="mx-auto max-w-screen-xl pb-3">
      <div class="overflow-hidden sm:rounded-xl bg-white shadow">
        <form class="rounded-xl divide-gray-200 lg:col-span-9">
          <div class="flex justify-center">
            <img :src="qrcode">
          </div>
          <div class="flex justify-center">
            <div>Scan to connect to device</div>
          </div>
          <div class="flex justify-end">
            <AppButton>Add Device</AppButton>
          </div>
        </form>
      </div>
    </div>
  </main>

</template>

<script setup lang="ts">
import { useDeviceStore } from '@/store/@admin/DeviceStore'
import { useQRCode } from '@vueuse/integrations/useQRCode'
import { idGenerator } from '@/helpers/Converter'

import AppButton from '@/components/form/AppButton.vue'

const $device = useDeviceStore()
const qrcode = useQRCode(JSON.stringify($device.params))
</script>
