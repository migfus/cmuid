<template>
  <div>
    <h3 class="text-lg font-medium leading-6 text-gray-500 sm:rounded-xl bg-white p-4 shadow flex justify-between">
      <span>Last 30 days</span>
      <span>{{ dateTime }}</span>
    </h3>
    <dl class="mt-4 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden sm:rounded-xl bg-white shadow md:grid-cols-3 md:divide-y-0 md:divide-x">
      <div v-for="item in stats" :key="item.name" class="px-4 py-5 sm:p-6">
        <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
        <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
          <div class="flex items-baseline text-2xl font-semibold text-primary-600">
            {{ item.stat }}
            <span class="ml-2 text-sm font-medium text-gray-500">from {{ item.previousStat }}</span>
          </div>

          <div :class="[item.changeType === 'increase' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800', 'inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium md:mt-2 lg:mt-0']">
            <ArrowUpIcon v-if="item.changeType === 'increase'" class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
            <ArrowDownIcon v-else class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500" aria-hidden="true" />
            <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
            {{ item.change }}
          </div>
        </dd>
      </div>
    </dl>
  </div>
</template>

<script setup lang="ts">
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'
import moment from 'moment'
import { onMounted, onUnmounted, ref } from 'vue'

const stats = [
  { name: 'New Requests', stat: '71,897', previousStat: '70,946', change: '12%', changeType: 'increase' },
  { name: 'Lol', stat: '58.16%', previousStat: '56.14%', change: '2.02%', changeType: 'increase' },
  { name: 'Unique Visitors', stat: '24.57%', previousStat: '28.62%', change: '4.05%', changeType: 'decrease' },
]

const dateTime = ref(moment().format('MMM DD, YYYY hh:mm ss A'))

let timeController;

onMounted(() => {
  timeController = setInterval(() => {
    dateTime.value = moment().format('MMM DD, YYYY hh:mm ss A')
  }, 1000)
})

onUnmounted(() => {
  clearInterval(timeController)
})
</script>
