<template>
    <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-2">
      <ul role="list" class=" divide-gray-200 rounded-xl">
        <h1 class="p-4 font-bold text-gray-500">Add Device</h1>

        <Form v-slot="{ errors }" :validation-schema="schema" @submit="$device.PostAPI()">
          <div class="m-4">



            <div class="flex justify-end">
              <AppButton @click="$device.Reset()" :loading="$device.config.buttonLoading" class="mt-4 mr-2" color="danger">Cancel</AppButton>
              <AppButton @click="$device.PostAPI()" :loading="$device.config.buttonLoading" :disabled="Object.keys(errors).length != 0" class="mt-4">Submit</AppButton>
            </div>

          </div>
        </Form>

      </ul>
    </div>

</template>

<script setup lang="ts">
import { useDeviceStore } from '@/store/@admin/DeviceStore'
import * as Yup from 'yup'
import { Form, configure } from 'vee-validate'


import AppButton from '@/components/form/AppButton.vue'
import { CalendarIcon, MapPinIcon, MapIcon, DevicePhoneMobileIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'

configure({
    validateOnInput: true
})

const $device = useDeviceStore()

const schema = Yup.object({
  name: Yup.string().required('Device name is required'),
  platform: Yup.string().required('Platform is required'),
})



</script>
