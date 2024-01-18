<template>
  <div>
    <Layout>
      <div class="lg:col-span-9">
        <!-- SECTION FORMS -->
        <BasicTransition>
          <main v-if="$req.config.form != ''" class="relative">
            <div class="mx-auto max-w-screen-xl pb-3">
              <div class="overflow-hidden sm:rounded-xl bg-white shadow">
                <form class="rounded-xl divide-y divide-gray-200 lg:col-span-9">
                  <div class="py-6 px-4 sm:p-6 lg:pb-8">
                    <div>
                      <h2 class="text-lg font-medium leading-6 text-gray-900">Claimed</h2>
                    </div>
                    <div class="mt-6">
                      <div class="grid grid-cols-12 gap-2">
                        <div class="col-span-12 sm:col-span-6">
                          <QuillEditor theme="snow" v-model:content="$req.params.content" toolbar="minimal" contentType="html"/>
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                          <AppTextArea v-model="$req.params.sms" name="sms" placeholder="SMS Notification" />
                          <span :class="[smsLength > 160 ? 'text-red-600' : 'text-gray-500']">{{ smsLength }}/160 Characters</span>
                        </div>

                        <div class="flex-none sm:flex justify-end mt-3 gap-2 col-span-12">
                          <Switch v-model="$req.params.sendSMS" :class="[$req.params.sendSMS ? 'bg-primary-600' : 'bg-gray-200', 'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2']">
                            <span class="sr-only">Use setting</span>
                            <span aria-hidden="true" :class="[$req.params.sendSMS ? 'translate-x-5' : 'translate-x-0', 'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out']" />
                          </Switch>
                          <AppButton @click="$req.ChangeForm(null, '')" color='danger' :loading="$req.config.buttonLoading" class="w-full sm:w-auto mb-2 sm:mb-0">Cancel</AppButton>
                          <AppButton @click="$req.FeedbackAPI()" color='white' :loading="$req.config.buttonLoading" class="w-full sm:w-auto mb-2 sm:mb-0">Done</AppButton>
                        </div>
                      </div>
                    </div>

                  </div>

                </form>
              </div>
            </div>
          </main>
        </BasicTransition>

        <!-- SECTION CONTENT -->
        <ContentCard :data="$req">
          <DataTransition>
            <li v-for="row in $req.content.data" :key="row.id">
              <InfoCardVue :data="row">
                <ActionButtonVue
                  @complete="$req.ChangeForm(row, 'complete')"
                  @cancel="$req.ChangeForm(row, 'cancel')"
                  @claim="$req.ChangeForm(row, 'claim')"
                  @feedback="$req.ChangeForm(row, 'feedback')"
                  defaultButtonName="Complete"
                />
              </InfoCardVue>
            </li>
          </DataTransition>
        </ContentCard>
      </div>
  </Layout>
</div>
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue'
import { useClaimedRequestDashboardStore } from '@/store/dashboard/ClaimedRequestDashboardStore'
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css'

import Layout from    './~Components/Layout.vue'
import ContentCard from './~Components/ContentCard.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import AppButton from '@/components/form/AppButton.vue'
import AppTextArea from '@/components/form/AppTextArea.vue'
import { Switch } from '@headlessui/vue'
import DataTransition from '@/components/transitions/DataTransition.vue'
import ActionButtonVue from './~Components/ActionButton.vue'
import InfoCardVue from '@/components/cards/InfoCard.vue'

const $req = useClaimedRequestDashboardStore()

const smsLength = computed(() => {
  return $req.params.sms.length
})

onMounted(() => {
  $req.GetAPI();
})
</script>
