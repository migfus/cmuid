<template>
  <BasicTransition>
    <div v-if="$request.config.show" class="overflow-hidden bg-white shadow sm:rounded-xl mb-2">
      <ul role="list" class=" divide-gray-200 rounded-xl">
        <h1 class="p-4 font-bold text-gray-500">Feedback - {{ $request.config.show }}</h1>

        <strong class="mb-2 m-4">{{ $request.params.name }}</strong>

        <div class="m-4 grid grid-cols-2 gap-4">
          <div class="mb-4 col-span-2 sm:col-span-1">
            <QuillEditor theme="snow" v-model:content="$request.params.content" toolbar="minimal" contentType="html"/>
          </div>

          <div class="mt-4 col-span-2 sm:col-span-1">
            <AppTextArea v-model="$request.params.sms" name="sms" placeholder="SMS Notification" />

            <div class="flex justify-end mt-2">
              <Switch v-model="$request.params.sendSMS" :class="[$request.params.sendSMS ? 'bg-primary-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2']">
                <span class="sr-only">Use setting</span>
                <span aria-hidden="true" :class="[$request.params.sendSMS ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
              </Switch>
            </div>


          </div>

        </div>

        <div class="flex justify-end mb-4 mr-4">
          <AppButton @click="$request.ShowChange('')" :loading="$request.config.buttonLoading" class="mt-4 mr-2" color="danger">Cancel</AppButton>
          <AppButton @click="$request.FeedbackAPI(); $request.ShowChange('')" :loading="$request.config.buttonLoading" class="mt-4">Submit</AppButton>
        </div>
      </ul>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-xl">
      <ul role="list" class="divide-y divide-gray-200 rounded-xl">
        <h1 class="p-4 font-bold text-gray-500">{{ $props.title }}</h1>
      </ul>
    </div>
  </BasicTransition>
</template>

<script setup lang="ts">
import { useRequestStore } from '@/store/@admin/RequestStore'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import BasicTransition from '@/components/transitions/BasicTransition.vue'
import AppButton from '@/components/form/AppButton.vue'
import AppTextArea from '@/components/form/AppTextArea.vue'
import { Switch } from '@headlessui/vue'

const $props = defineProps<{
  title: string
}>()
const $request = useRequestStore()
</script>
