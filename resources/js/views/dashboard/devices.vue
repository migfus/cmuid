<template>
  <BasicTransition>
    <!-- <div v-if="$request.config.show" class="overflow-hidden bg-white shadow sm:rounded-xl mb-2">
      <ul role="list" class=" divide-gray-200 rounded-xl">
        <h1 class="p-4 font-bold text-gray-500">Feedback - {{ $request.config.show }}</h1>

        <strong class="mb-2 m-4">{{ $request.params.name }}</strong>

        <div class="m-4">
          <QuillEditor theme="snow" v-model:content="$request.params.content" toolbar="full" contentType="html"/>

          <div class="flex justify-end">
            <AppButton @click="$request.ShowChange('')" :loading="$request.config.buttonLoading" class="mt-4 mr-2" color="danger">Cancel</AppButton>
            <AppButton @click="$request.FeedbackAPI(); $request.ShowChange('')" :loading="$request.config.buttonLoading" class="mt-4">Submit</AppButton>
          </div>

        </div>
      </ul>
    </div> -->
  </BasicTransition>


  <div class="overflow-hidden bg-white shadow sm:rounded-xl">
    <ul role="list" class="divide-y divide-gray-200 rounded-xl">
      <h1 class="p-4 font-bold text-gray-500">Devices</h1>

      <DataTransition>
        <DeviceData v-for="row in $device.content" :key="row.id" :id="row.id" :name="row.name" :platform="row.platform" :last_response="row.last_response"/>
      </DataTransition>

    </ul>
  </div>
</template>

<script setup lang="ts">
import { useDeviceStore } from '@/store/@admin/DeviceStore'
import { onMounted } from 'vue'

import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import DeviceData from './~Components/DeviceData.vue'

const $device = useDeviceStore()

onMounted(() => {
  $device.GetAPI()
})
</script>
