<template>
  <div>
    <Layout>
      <div class=" lg:col-span-9">
        <BasicTransition>
          <Form v-if="$file.config.form" v-slot="{ errors }" :validation-schema="schema" @submit="$file.PostAPI()" class="divide-y divide-gray-200 lg:col-span-9">
            <!-- Profile section -->
            <div class="py-6 px-4 sm:p-6 lg:pb-8 bg-white sm:rounded-xl shadow mb-2">
              <div>
                <h2 class="text-lg font-medium leading-6 text-gray-900 mb-4">Upload Soft-Copy CSC ID</h2>
              </div>

              <div class="grid grid-cols-2 gap-2">
                <div class="col-span-2 md:col-span-1 mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                  <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                      <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                      <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-primary-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:text-primary-500">
                        <span>Upload a file</span>
                        <Field @change="AddPicture($event)" id="file-upload" name="picture" type="file" class="sr-only" accept="image/*"/>
                      </label>
                      <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                  </div>
                </div>

                <img v-if="$file.params.picture" :src="preview" class="col-span-2 md:col-span-1 mt-2 rounded-xl shadow h-64 w-auto mb-2">
                <div v-else class="col-span-2 md:col-span-1 mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                  <div class="space-y-1 text-center">
                    <QuestionMarkCircleIcon class="inline-block w-12 h-12 text-gray-400"/>

                    <div class="flex text-sm text-gray-600">
                      Preview File
                    </div>
                  </div>
                </div>
              </div>

              <ErrorMessage name="picture" class="text-sm font-medium text-red-500"/>

              <div class="flex-none sm:flex justify-end mt-8 gap-1">
                <AppButton @click="$file.ChangeForm(null, ''); preview = null" color='white' class="mr-1 w-full sm:w-auto mb-2 sm:mb-0">Cancel</AppButton>
                <AppButton type="submit" color='white' class="mr-1 w-full sm:w-auto mb-2 sm:mb-0" :disabled="Object.keys(errors).length != 0" :loading="$file.config.buttonLoading">Upload</AppButton>
              </div>
            </div>
          </Form>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContentCard
          title="Not Attached"
          :config="$file.config"
          @actionCreateClick="$file.ChangeForm(null, 'create')"
          @actionCancelClick="$file.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$file.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $file.content.data" :key="row.id">
                <InfoCard :data="row">
                  <AppButton @click="$file.ChangeForm(row, 'create')" size="sm" :loading="$file.config.buttonLoading">Add Attachement</AppButton>
                </InfoCard>
              </li>
            </DataTransition>
          </template>
        </ContentCard>

        <div v-if="$file.content.total > 10" class="flex justify-end bg-white p-4 rounded-xl shadow mb-2">
          <TailwindPagination
            :data="$file.content"
            @pagination-change-page="$file.GetAPI"
            activeClasses="bg-gray-300"
            itemClasses="shadow border-0"
          />
        </div>
      </div>
    </Layout>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue'
import { useUploadSoftCopyDashboardStore } from '@/store/dashboard/UploadSoftCopyDashboardStore'
import * as Yup from 'yup'
import { Form, configure, ErrorMessage, Field } from 'vee-validate'
import { useDebounceFn } from '@vueuse/core'

import { QuestionMarkCircleIcon } from '@heroicons/vue/20/solid'
import Layout from    './~Components/Layout.vue'
import AppButton from '@/components/form/AppButton.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import ContentCard from './~Components/ContentCard.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import AppInput from '@/components/form/AppInput.vue'
import { TailwindPagination } from 'laravel-vue-pagination'
import InfoCard from '@/components/cards/InfoCard.vue'

configure({
  validateOnInput: true
})

const schema = Yup.object({
  picture: Yup.mixed().required('Picture is required'),
})

const $file = useUploadSoftCopyDashboardStore()
const preview = ref(null)

function AddPicture(events) {
  $file.params.picture = events.target.files[0]

  const reader = new FileReader()
  reader.onload = (e) => {
    preview.value = e.target.result
  }
  // @ts-ignore
  reader.readAsDataURL($file.params.picture)
}

watch($file.query, useDebounceFn(() => {
  $file.GetAPI()
}, 1000))

onMounted(() => {
  $file.GetAPI()
})
</script>
