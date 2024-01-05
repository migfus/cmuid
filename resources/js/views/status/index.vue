<template>
  <div class='h-full'>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Check CSC ID</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form v-slot="{errors}" class="space-y-6" :validation-schema="schema" @submit="submit()">
            <div>
              <AppInput v-model="input.id" mask="cscid_*****" name="id" placeholder="CSC ID" :errors="errors"/>
            </div>

            <div>
              <AppButton block type="submit" :disabled="Object.keys(errors).length != 0">
                Check
              </AppButton>
            </div>
          </Form>


        </div>
      </div>
    </div>
  </div>

</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import { Form, configure } from 'vee-validate'
import * as Yup from 'yup'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from '@/components/form/AppInput.vue'

const $router = useRouter()

configure({
  validateOnInput: true
})

interface InputInt {
  id: string
}

const schema = Yup.object({
  id: Yup.string().required('CSC ID is required'),
})

const input = reactive<InputInt>({
  id: '',
});

function submit() {
  $router.push(`/status/${input.id.replace("cscid_", "")}`)
}
</script>
