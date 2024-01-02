<template>
  <BasicTransition>
    <div v-if="$request.config.show" class="overflow-hidden bg-white shadow sm:rounded-xl mb-2">
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
    </div>
  </BasicTransition>


  <div class="overflow-hidden bg-white shadow sm:rounded-xl">
    <ul role="list" class="divide-y divide-gray-200 rounded-xl">
      <h1 class="p-4 font-bold text-gray-500">Requesting</h1>

      <DataTransition>
        <li v-for="row in $request.content" :key="row.id">
          <div class="block hover:bg-gray-50">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="truncate text-md font-medium text-gray-600">{{ FullName(row) }}</p>
                <div class="ml-2 flex flex-shrink-0">
                  <p class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">Pending</p>
                </div>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">

                  <p class="flex items-center text-sm text-gray-500">
                    <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.position }}
                  </p>

                  <p v-if="row.unit || row.department" class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                    <MapIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.unit ? `${row.unit},` : '' }} {{  row.department ?? '' }}
                  </p>

                  <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                    <DevicePhoneMobileIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ MobileFormat(row.mobile) }}
                  </p>

                  <p v-if="row.email" class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                    <EnvelopeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.email }}
                  </p>

                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                  <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                  <p>
                    <time :datetime="moment(row.created_at).format('MM/DD/YYYY')">{{ moment(row.created_at).fromNow() }}</time>
                  </p>
                </div>
              </div>

              <div class="grid grid-cols-2 mt-4 justify-evenly">
                <img :src="row.picture" class="h-48 w-auto rounded-xl"/>
                <div class="flex justify-end gap-2">
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Cancel', FullName(row))" :loading="$request.config.buttonLoading" color="danger" class="mt-auto">Cancel</AppButton>
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Feedback', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Feedback</AppButton>
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Done', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Done</AppButton>
                </div>
              </div>

            </div>
          </div>
        </li>
      </DataTransition>


    </ul>
  </div>
</template>

<script setup lang="ts">
import { CalendarIcon, MapPinIcon, MapIcon, DevicePhoneMobileIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'
import { useRequestStore } from '@/store/@admin/RequestStore'
import { onMounted } from 'vue'
import { FullName, MobileFormat } from '@/helpers/Converter'
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import BasicTransition from '@/components/transitions/BasicTransition.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import AppButton from '@/components/form/AppButton.vue'

const $request = useRequestStore()

onMounted(() => {
  $request.query.filter = 'request'
  $request.GetAPI()
})
</script>
