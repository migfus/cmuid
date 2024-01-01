<template>


    <div v-if="$status.config.contentLoading" class="bg-white sm:rounded-xl shadow px-6 py-4">
      Loading
    </div>

    <div v-else class="bg-white sm:rounded-xl shadow">
      <div class="flow-root">
        <ul role="list" class="px-4 py-0 divide-y divide-gray-200">
          <h1 class="p-4 font-bold text-gray-500">Information</h1>


        </ul>
      </div>
    </div>


</template>

<script setup lang="ts">
import { ClockIcon, XMarkIcon, PlusIcon, ChatBubbleOvalLeftEllipsisIcon } from '@heroicons/vue/20/solid'
import { useStatusStore } from '@/store/StatusStore'
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { FullName } from "@/helpers/Converter"
import moment from 'moment'

const $route = useRoute()
const $status = useStatusStore()

onMounted(() => {
  // @ts-ignore
  $status.ShowAPI($route.params.id)
})
</script>
