<template>
  <div v-if="!$status.content" class="bg-white sm:rounded-xl shadow px-6 py-4">
    Loading
  </div>

  <div v-else class="bg-white sm:rounded-xl shadow">
    <div class="flow-root">
      <ul role="list" class="px-4 py-0 divide-y divide-gray-200">
        <h1 class="p-4 font-bold text-gray-500">Status</h1>
        <li v-for="(row, idx) in $status.content.status" :key="row.id">
          <div class="relative pb-8">

            <div class="relative flex items-start space-x-3">

              <template v-if="row.status_category.name == 'Post'">
                <div class="relative">
                  <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" :src="row.requesting.thumbnail" alt="" />
                  <span class="absolute -bottom-0.5 -right-1 rounded-full bg-white px-0.5 py-px">
                    <PlusIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                </div>
                <div class="min-w-0 flex-1">
                  <div>
                    <div class="text-sm">
                      <div class="font-medium text-gray-900">{{ FullName(row.requesting) }}</div>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Registered in {{ moment(row.created_at).fromNow(true) }}</p>
                  </div>
                  <div class="mt-2 text-sm text-gray-700">
                    <p>{{ row.content }}</p>
                  </div>
                </div>
              </template>

              <template v-else-if="row.status_category.name === 'Pending'" condition="row.category.name === 'Pending'">
                <div>
                  <div class="relative px-1">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                      <ClockIcon class="h-5 w-5 text-gray-500" aria-hidden="true" />
                    </div>
                  </div>
                </div>
                <div class="min-w-0 flex-1 py-1.5">
                  <div class="text-sm text-gray-500">
                    <div class="font-medium text-gray-900">Waiting to process</div>
                    This may take a while, we'll notify you for any updates.
                  </div>
                </div>
              </template>

              <template v-if="row.status_category.name == 'Feedback'">
                <div class="relative">
                  <img class="flex h-10 w-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" :src="row.user.avatar" alt="" />
                  <span class="absolute -bottom-0.5 -right-1 rounded-full bg-white px-0.5 py-px">
                    <ChatBubbleOvalLeftEllipsisIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                </div>
                <div class="min-w-0 flex-1">
                  <div>
                    <div class="text-sm">
                      <div class="font-medium text-gray-900">{{ row.user.email }}</div>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">Feedback on {{ moment(row.created_at).fromNow(true) }}</p>
                  </div>
                  <div class="mt-2 text-sm text-gray-700">
                    <p v-html="row.content"></p>
                  </div>
                </div>
              </template>

              <template v-else-if="row.status_category.name === 'Cancelled'">
                <div>
                  <div class="relative px-1">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 ring-8 ring-white">
                      <XMarkIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
                    </div>
                  </div>
                </div>
                <div class="min-w-0 flex-1 py-1.5">
                  <div class="text-sm text-gray-500">
                    <div class="font-medium text-red-600">Cancelled</div>
                    <div class="font-sm text-gray-500">{{ moment(row.created_at).fromNow(true)}}</div>
                    <div class="mt-2 text-sm text-gray-700">
                      <p v-html="row.content"></p>
                    </div>
                  </div>
                </div>
              </template>

              <template v-else-if="row.status_category.name === 'Done'">
                <div>
                  <div class="relative px-1">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 ring-8 ring-white">
                      <CheckCircleIcon class="h-5 w-5 text-green-500" aria-hidden="true" />
                    </div>
                  </div>
                </div>
                <div class="min-w-0 flex-1 py-1.5">
                  <div class="text-sm text-gray-500">
                    <div class="font-medium text-green-600">Done</div>
                    <div class="font-sm text-gray-500">{{ moment(row.created_at).fromNow(true)}}</div>
                    <div class="mt-2 text-sm text-gray-700">
                      <p v-html="row.content"></p>
                    </div>
                  </div>
                </div>
              </template>

            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

</template>

<script setup lang="ts">
import { ClockIcon, XMarkIcon, PlusIcon, ChatBubbleOvalLeftEllipsisIcon, CheckCircleIcon } from '@heroicons/vue/20/solid'
import { useStatusPublicStore } from '@/store/public/StatusPublicStore'
import { FullName } from "@/helpers/Converter"
import moment from 'moment'

const $status = useStatusPublicStore()
</script>
