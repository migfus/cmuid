<template>
  <div class="grid grid-cols-1 xl:grid-cols-2 gap-2 mt-2">
    <DataTransition>
      <li v-for="row in $request.content" :key="row.id" class="bg-white rounded-xl shadow list-none">
        <div class="col-span-1">
          <div class="block ">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="truncate text-md font-medium text-gray-600">{{ FullName(row) }}</p>
                <div class="ml-2 flex flex-shrink-0">
                  <p class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">Pending</p>
                </div>
              </div>
              <div class="mt-2 sm:flex sm:justify-between">
                <div class="">

                  <p class="flex items-center text-sm text-gray-500 mb-2">
                    <MapPinIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.position }}
                  </p>

                  <p v-if="row.unit || row.department" class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 mb-2">
                    <MapIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.unit ? `${row.unit},` : '' }} {{  row.department ?? '' }}
                  </p>

                  <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 mb-2">
                    <DevicePhoneMobileIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ MobileFormat(row.mobile) }}
                  </p>

                  <p v-if="row.email" class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 mb-2">
                    <EnvelopeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                    {{ row.email }}
                  </p>

                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                  <p>
                    <time :datetime="moment(row.created_at).format('MM/DD/YYYY')">{{ moment(row.created_at).fromNow(true) }}</time>
                  </p>
                </div>
              </div>

              <div class="mt-4 justify-evenly mb-2">
                <img :src="row.picture" class="h-48 w-auto rounded-xl"/>
              </div>

              <div class="justify-evenly">
                <div class="flex justify-end gap-2">
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Cancel', FullName(row))" :loading="$request.config.buttonLoading" color="danger" class="mt-auto">Cancel</AppButton>
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Feedback', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Feedback</AppButton>
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Done', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Done</AppButton>
                  <AppButton @click="$request.params.id = row.id; $request.ShowChange('Claimed', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Claim</AppButton>
                </div>
              </div>

            </div>
          </div>
        </div>

      </li>
    </DataTransition>
  </div>

</template>

<script setup lang="ts">
import { useRequestStore } from '@/store/@admin/RequestStore'
import { FullName, MobileFormat } from '@/helpers/Converter'
import moment from 'moment'

import DataTransition from '@/components/transitions/DataTransition.vue'
import { MapPinIcon, MapIcon, DevicePhoneMobileIcon, EnvelopeIcon } from '@heroicons/vue/20/solid'
import AppButton from '@/components/form/AppButton.vue'

const $request = useRequestStore()
</script>
