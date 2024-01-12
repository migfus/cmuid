<template>
  <div class="inline-flex rounded-xl shadow-sm">
    <button @click="$emit('complete')" type="button" class="shadow relative inline-flex items-center rounded-l-xl bg-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">{{ $props.defaultButtonName }}</button>
    <Menu as="div" class="relative -ml-px block">
      <MenuButton class="relative inline-flex items-center rounded-r-xl bg-gray-200 shadow px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-300 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-1 focus:ring-primary-500">
        <span class="sr-only">Open options</span>
        <ChevronDownIcon class="h-5 w-5" aria-hidden="true" />
      </MenuButton>
      <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <MenuItems class="absolute right-0 z-10 mt-1 -mr- w-56 origin-top-right rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
          <div @click="$emit('cancel')" class="py-1 w-full hover:bg-gray-300 rounded-t-xl cursor-pointer">
            <MenuItem class="">
              <button class="text-gray-700 block px-4 py-2 text-sm font-medium">Cancel</button>
            </MenuItem>
          </div>
          <div @click="$emit('claim')" class="py-1 w-full hover:bg-gray-300 cursor-pointer">
            <MenuItem class="">
              <button class="text-gray-700 block px-4 py-2 text-sm font-medium">Claim</button>
            </MenuItem>
          </div>
          <div @click="$emit('feedback')" class="py-1 w-full hover:bg-gray-300 rounded-b-xl cursor-pointer">
            <MenuItem class="">
              <button class="text-gray-700 block px-4 py-2 text-sm font-medium">Feedback</button>
            </MenuItem>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </div>
</template>

<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'

const $props = defineProps<{
  defaultButtonName: string
}>()
const $emit = defineEmits(['complete', 'cancel', 'claim', 'feedback']);
</script>
