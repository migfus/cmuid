<template>
  <h2 class="bg-white mb-3 sm:rounded-xl p-5 shadow font-bold text-gray-600 grid grid-cols-12">
    <div class="col-span-6 mt-1 header-title">
      {{ $req.query.filter }}
    </div>
    <div class="col-span-6">
      <AppInput v-model="$req.query.search" name="search" placeholder="Search" noLabel/>
    </div>
  </h2>

  <div class="sm:p-0">

    <div class="overflow-hidden bg-white shadow sm:rounded-xl mb-3">
      <ul role="list" class="divide-y divide-gray-200">
        <DataTransition>
          <li v-for="row in $req.content.data" :key="row.id">
            <div class="block">
              <div class="px-4 py-4 sm:px-6">
                <div class="grid grid-cols-3 items-center justify-between">

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <UserCircleIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ FullName(row) }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <MapPinIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ row.position }}
                  </p>

                  <div class="ml-2 flex justify-end">
                    <ActionButton
                      @complete="$req.ChangeForm(row, 'complete')"
                      @cancel="$req.ChangeForm(row, 'cancel')"
                      @claim="$req.ChangeForm(row, 'claim')"
                      @feedback="$req.ChangeForm(row, 'feedback')"
                      defaultButtonName="Complete"
                    />
                  </div>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <MapIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ `${row.unit}, ${row.department}` }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <DevicePhoneMobileIcon  class="inline-block h-5 w-5 text-gray-400"/>
                    {{ MobileFormat(row.mobile) }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2 flex justify-end">
                    {{ moment(row.created_at).fromNow(true) }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <EnvelopeIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ row.email }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <WalletIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ row.claim_type.name }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2 flex justify-end">
                    cscid_{{ row.id }}
                  </p>

                  <p class="truncate text-md font-medium text-gray-600 mb-2">
                    <QueueListIcon class="inline-block h-5 w-5 text-gray-400"/>
                    {{ row.status_category.name }}
                  </p>
                </div>

                <div class="flex relative">
                  <a :href="row.picture" target="_blank" class="relative block bg-gray-900 group rounded-xl shadow my-2">
                    <img :src="row.picture" class="absolute inset-0 object-cover w-auto h-32 group-hover:opacity-50 rounded-xl" />
                    <div class="relative h-32 w-auto">
                      <div class="transition-all transform translate-y-5 opacity-0 group-hover:opacity-100 group-hover:translate-y-0">
                        <AppButton class="">Download</AppButton>
                      </div>
                    </div>
                  </a>
                </div>

              </div>
            </div>
          </li>
        </DataTransition>
      </ul>
    </div>
  </div>

  <div class="flex justify-end bg-white p-4 rounded-xl shadow mb-2">
    <TailwindPagination
        :data="$req.content"
        @pagination-change-page="$req.GetAPI"
    />
  </div>

</template>

<script setup lang="ts">
import { useRequestStore } from '@/store/@admin/RequestStore'
import { FullName, MobileFormat } from '@/helpers/Converter'
import moment from 'moment'
import { watch } from 'vue'
import { useDebounceFn } from '@vueuse/core'

import { UserCircleIcon, MapPinIcon, MapIcon, DevicePhoneMobileIcon, EnvelopeIcon, WalletIcon, QueueListIcon } from '@heroicons/vue/20/solid'
import AppInput from '@/components/form/AppInput.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import ActionButton from './ActionButton.vue'
import AppButton from '@/components/form/AppButton.vue'
import { TailwindPagination } from 'laravel-vue-pagination';

const $req = useRequestStore()

watch($req.query, useDebounceFn(() => {
  $req.GetAPI()
}, 1000))
</script>

<style scoped>
.header-title {
  text-transform:capitalize;
}
</style>
