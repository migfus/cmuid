<template>
  <div v-if="$auth.token && $auth.content" class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
    <button type="button" class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
      <span class="sr-only">View notifications</span>
      <BellIcon class="h-6 w-6" aria-hidden="true" />
    </button>

    <!-- Profile dropdown -->
    <Menu as="div" class="relative ml-3" v-slot="{ close }">
      <div>
        <MenuButton class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
          <span class="sr-only">Open user menu</span>
          <img class="h-8 w-8 rounded-full" :src="$auth.content.auth.avatar" alt="" />
        </MenuButton>
      </div>
      <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <MenuItems class="bg-opacity-80 backdrop-blur absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
          <MenuItem v-slot="{ active }">
            <RouterLink @click="close" :to="{name: 'dashboard'}" :class="[active || $route.name == 'dashboard' ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
              <WindowIcon class="h-5 w-5 inline-block mr-1" aria-hidden="true" />
              Dashboard
            </RouterLink>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <RouterLink :to="{name: 'requesting'}" :class="[active || $route.name == 'request-list' ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
              <UserPlusIcon class="h-5 w-5 inline-block mr-1" aria-hidden="true" />
              Requesting
            </RouterLink>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <RouterLink :to="{name: 'upload'}" :class="[active || $route.name == 'upload' ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
              <ArrowUpOnSquareIcon class="h-5 w-5 inline-block mr-1" aria-hidden="true" />
              Upload Soft-copy
            </RouterLink>
          </MenuItem>
          <MenuItem v-slot="{ active }">
            <RouterLink :to="{name: 'devices'}" :class="[active || $route.name == 'devices' ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
              <DevicePhoneMobileIcon class="h-5 w-5 inline-block mr-1" aria-hidden="true" />
              Devices
            </RouterLink>
          </MenuItem>

          <MenuItem v-slot="{ active }">
            <a @click="$auth.Logout()" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700 cursor-pointer']">
              <XMarkIcon class="h-5 w-5 inline-block mr-1" aria-hidden="true" />
              Sign out
            </a>
          </MenuItem>
        </MenuItems>
      </transition>
    </Menu>
  </div>

  <div v-else class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
    <RouterLink :to="{name: 'login'}" class="ml-3 inline-flex items-center justify-center">
      <AppButton color="white">
        Login
      </AppButton>
    </RouterLink>
  </div>
</template>

<script setup lang='ts'>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { useAuthPublicStore } from '@/store/public/AuthPublicStore'
import { BellIcon, WindowIcon, XMarkIcon, UserPlusIcon, ArrowUpOnSquareIcon, DevicePhoneMobileIcon } from '@heroicons/vue/24/outline'
import AppButton from '@/components/form/AppButton.vue'

const $auth = useAuthPublicStore()
</script>
