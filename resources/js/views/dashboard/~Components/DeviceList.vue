<template>
  <div class="overflow-hidden bg-white shadow sm:rounded-xl">
    <ul role="list" class="divide-y divide-gray-200">
      <div class="ml-4 sm:ml-6 my-2">
        Devices
      </div>
      <li v-for="row in applications" :key="row.name">
        <RouterLink :to="{name: 'devices'}" class="block hover:bg-gray-50">
          <div class="flex justify-between py-4 px-4 sm:px-6">
            <p class="truncate text-sm font-medium text-gray-600">{{ row.name }}</p>

            <div class="items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">Badge</div>
          </div>
          <div class="flex justify-end pr-6 pb-4">
            <p class="truncate text-sm font-medium text-gray-600">{{ row.date }}</p>
          </div>
        </RouterLink>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
const applications = [
  {
    name: 'Poco',
    date: '2023-02-02'
  },
  {
    name: 'Samsung',
    date: '2023-02-02'
  },
]
</script>
