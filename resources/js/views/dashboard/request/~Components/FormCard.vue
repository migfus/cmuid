<template>
  <main  class="relative">
    <div class="mx-auto max-w-screen-xl pb-3">
      <div class="overflow-hidden sm:rounded-xl bg-white shadow">
        <form class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
          <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
              <h2 class="text-lg font-medium leading-6 text-gray-900">{{  $props.title }}</h2>
            </div>
            <div class="mt-6">
              <div class="grid grid-cols-12 gap-2">
                <slot></slot>

                <div class="flex-none sm:flex justify-end mt-3 gap-2 col-span-12">
                  <Switch v-model="$model" :class="[$model ? 'bg-primary-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2']">
                    <span class="sr-only">Use setting</span>
                    <span aria-hidden="true" :class="[$model ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                  </Switch>
                  <AppButton @click="$emit('cancelClick')" color='danger' :loading="$props.loading" class="w-full sm:w-auto mb-2 sm:mb-0">Cancel</AppButton>
                  <AppButton @click="$emit('submitForm')" color='white' :loading="$props.loading" class="w-full sm:w-auto mb-2 sm:mb-0">{{ $props.submitButtonName }}</AppButton>
                </div>
              </div>
            </div>

          </div>

        </form>
      </div>
    </div>
  </main>
</template>

<script setup lang="ts">
import AppButton from '@/components/form/AppButton.vue'
import { Switch } from '@headlessui/vue'

const $props = defineProps<{
  title: string
  submitButtonName: string
  loading: boolean
  enctype?: string
}>()
const $emit = defineEmits(['submitForm', 'cancelClick'])
const $model = defineModel<boolean>()


</script>
