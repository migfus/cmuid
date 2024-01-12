<template>
  <div class="block hover:bg-gray-50">
    <div class="px-4 py-4 sm:px-6">
      <div class="grid grid-cols-3 items-center justify-between">

        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2 flex justify-between">
          <div class="">
            <UserCircleIcon class="inline-block h-5 w-5 text-gray-400"/>
            {{ FullName($props.data) }}
          </div>

          <div class="sm:hidden">
            <slot></slot>
          </div>
        </p>

        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2 flex justify-between">
          <div class="">
            <MapPinIcon class="inline-block h-5 w-5 text-gray-400"/>
            {{ $props.data.position }}
          </div>

          <div class="flex sm:hidden">
            {{ moment($props.data.created_at).fromNow(true) }}
          </div>
        </p>

        <!-- NOTE SHOW ONLY ON LARGE SCREEEN -->
        <div class="ml-2 sm:flex justify-end hidden">
          <slot></slot>
        </div>

        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2 flex justify-between">
          <div class="">
            <MapIcon class="inline-block h-5 w-5 text-gray-400"/>
            {{ `${$props.data.unit}, ${$props.data.department}` }}
          </div>
          <div class="truncate sm:hidden">
            cscid_{{ $props.data.id }}
          </div>
        </p>

        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2">
          <DevicePhoneMobileIcon  class="inline-block h-5 w-5 text-gray-400"/>
          {{ MobileFormat($props.data.mobile) }}
        </p>

        <!-- NOTE SHOW ONLY ON LARGE SCREEEN -->
        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2 hidden sm:flex justify-end">
          {{ moment($props.data.created_at).fromNow(true) }}
        </p>

        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2">
          <EnvelopeIcon class="inline-block h-5 w-5 text-gray-400"/>
          {{ $props.data.email }}
        </p>


        <p class="col-span-3 sm:col-span-1 truncate text-md font-medium text-gray-600 mb-2">
          <WalletIcon class="inline-block h-5 w-5 text-gray-400"/>
          {{ $props.data.claim_type.name }}
        </p>

        <RouterLink :to="`/status/${$props.data.id}`" class="truncate text-md font-medium text-gray-600 mb-2 sm:flex justify-end hidden">
          cscid_{{ $props.data.id }}
        </RouterLink>


      </div>


      <div class="grid grid-cols-1 sm:grid-cols-2">
        <div class="flex relative ">
          <a :href="$props.data.picture" target="_blank" class="group/item">
            <div class="grou/edit invisible group-hover/item:visible absolute flex justify-center p-2 ">
              <AppButton size="sm">
                <ArrowDownCircleIcon class="inline-block h-5 w-5 text-gray-600"/>
              </AppButton>
            </div>

            <img :src="$props.data.thumbnail" class="w-auto h-32 rounded-xl" />
            <span class="text-gray-600">Raw Image</span>
          </a>
        </div>

        <div v-if="$props.data.files" class="flex relative">
          <div v-if="$props.data.files.length > 0">
            <a :href="$props.data.files[0].url" target="_blank" class="group/item">
              <div class="grou/edit invisible group-hover/item:visible absolute flex justify-center p-2 ">
                <AppButton size="sm">
                  <ArrowDownCircleIcon class="inline-block h-5 w-5 text-gray-600"/>
                </AppButton>
              </div>

              <img :src="$props.data.files[0].url" class="w-auto h-32 rounded-xl" />
              <span class="text-gray-600">CSC ID</span>
            </a>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { FullName, MobileFormat } from '@/helpers/Converter'
import moment from 'moment'

import {
  UserCircleIcon,
  MapPinIcon,
  MapIcon,
  DevicePhoneMobileIcon,
  EnvelopeIcon,
  WalletIcon,
  ArrowDownCircleIcon
} from '@heroicons/vue/20/solid'
import AppButton from '@/components/form/AppButton.vue'

const $props = defineProps<{
  data: any
}>()
</script>
