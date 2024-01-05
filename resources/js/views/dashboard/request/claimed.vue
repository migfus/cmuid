<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">
        <!-- SECTION FORMS -->
        <BasicTransition>
          <!-- NOTE ADD -->
          <FormCard
            v-if="$req.config.form != ''"
            :title="$req.config.form.toUpperCase() ?? ''"
            :loading="$req.config.buttonLoading"
            submitButtonName="Done"
            @submitForm="$req.FeedbackAPI()"
            @cancelClick="$req.ChangeForm(null, '')"
            v-model="$req.params.sendSMS"
          >
            <div class="col-span-12 sm:col-span-6">
              <QuillEditor theme="snow" v-model:content="$req.params.content" toolbar="minimal" contentType="html"/>
            </div>
            <div class="col-span-12 sm:col-span-6">
              <AppTextArea v-model="$req.params.sms" name="sms" placeholder="SMS Notification" />
              <span :class="[smsLength > 160 ? 'text-red-600' : 'text-gray-500']">{{ smsLength }}/160 Characters</span>
            </div>
          </FormCard>
        </BasicTransition>


        <!-- SECTION CONTENT -->
        <ContentCard
          title="Claimed"
          :config="$req.config"
          @actionCreateClick="$req.ChangeForm(null, 'create')"
          @actionCancelClick="$req.ChangeForm(null)"
        >
          <template #search>
            <AppInput v-model="$req.query.search" name="search" placeholder="Search" noLabel/>
          </template>
          <template #default>
            <DataTransition>
              <li v-for="row in $req.content" :key="row.id">
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


                    </div>



                    <img :src="row.picture" class="truncate text-md font-medium h-32 w-auto rounded-xl shadow mt-4" />
                  </div>
                </div>
              </li>
            </DataTransition>
          </template>
        </ContentCard>


      </div>



  </Layout>
</div>
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue'
import { useRequestStore } from '@/store/@admin/RequestStore'
import { FullName, MobileFormat } from '@/helpers/Converter'
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import { UserCircleIcon, MapPinIcon, MapIcon, DevicePhoneMobileIcon, EnvelopeIcon, WalletIcon } from '@heroicons/vue/20/solid'
import Layout from    './~Components/Layout.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import ContentCard from './~Components/ContentCard.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import AppInput from '@/components/form/AppInput.vue'
import FormCard from './~Components/FormCard.vue'
import AppTextArea from '@/components/form/AppTextArea.vue'
import ActionButton from './~Components/ActionButton.vue'

const $req = useRequestStore()

const smsLength = computed(() => {
  return $req.params.sms.length
})

onMounted(() => {
  $req.query.filter = 'claimed'
  $req.GetAPI()
})
</script>

<style scoped>
.ql-toolbar {
  border-radius: 80;
}
</style>
