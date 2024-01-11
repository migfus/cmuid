<template>
  <BasicTransition>
    <main v-if="$props.data.config.form != ''" class="relative">
      <div class="mx-auto max-w-screen-xl pb-3">
        <div class="overflow-hidden sm:rounded-xl bg-white shadow">
          <form class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
            <div class="py-6 px-4 sm:p-6 lg:pb-8">
              <div>
                <h2 class="text-lg font-medium leading-6 text-gray-900">{{  $props.data.config.form.toUpperCase() }}</h2>
              </div>
              <div class="mt-6">
                <div class="grid grid-cols-12 gap-2">
                  <div class="col-span-12 sm:col-span-6">
                    <QuillEditor theme="snow" v-model:content="$props.data.params.content" toolbar="minimal" contentType="html"/>
                  </div>
                  <div class="col-span-12 sm:col-span-6">
                    <AppTextArea v-model="$props.data.params.sms" name="sms" placeholder="SMS Notification" />
                    <span :class="[smsLength > 160 ? 'text-red-600' : 'text-gray-500']">{{ smsLength }}/160 Characters</span>
                  </div>

                  <div class="flex-none sm:flex justify-end mt-3 gap-2 col-span-12">
                    <Switch v-model="$props.data.params.sendSMS" :class="[$props.data.params.sendSMS ? 'bg-primary-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2']">
                      <span class="sr-only">Use setting</span>
                      <span aria-hidden="true" :class="[$props.data.params.sendSMS ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                    </Switch>
                    <AppButton @click="$props.data.ChangeForm(null, '')" color='danger' :loading="$props.data.config.buttonLoading" class="w-full sm:w-auto mb-2 sm:mb-0">Cancel</AppButton>
                    <AppButton @click="$props.data.FeedbackAPI()" color='white' :loading="$props.data.config.buttonLoading" class="w-full sm:w-auto mb-2 sm:mb-0">Done</AppButton>
                  </div>
                </div>
              </div>

            </div>

          </form>
        </div>
      </div>
    </main>
  </BasicTransition>

</template>

<script setup lang="ts">
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'
import { computed } from 'vue'

import AppButton from '@/components/form/AppButton.vue'
import { Switch } from '@headlessui/vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import AppTextArea from '@/components/form/AppTextArea.vue'

const $props = defineProps<{
  data: any
}>()

const smsLength = computed(() => {
  return $props.data.params.sms.length
})
</script>
