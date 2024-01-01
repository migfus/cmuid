<template>
  <div class='h-full grid grid-cols-1'>
    <div class="grid grid-cols-1 py-8 justify-items-center">
      <div class="sm:mx-auto sm:w-full sm:max-w-md mb-8">
        <!-- <object class="mx-auto h-40 w-auto" data="/images/logo-anim.svg" alt="Your Company" /> -->
        <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900">Register for CSC ID</h2>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <Form v-slot="{ errors }" :validation-schema="schema" @submit="$register.Next()" class="space-y-6">
            <div>
                <AppInput v-model="$register.params.email" placeholder="Email" name="email" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$register.params.password" placeholder="Password" name="password" type="password" :errors="errors"/>
            </div>

            <div>
              <AppInput v-model="$register.params.confirm_password" placeholder="Confirm Password" name="confirm_password" type="password" :errors="errors"/>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                <!-- <label for="remember-mee" class="ml-2 block text-sm text-gray-900">Agree to <RouterLink :to="{name: 'terms-agreement'}" class="text-gray-500 font-bold">Terms & Agreement</RouterLink></label> -->
              </div>

              <div class="text-sm">
                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Already Registered?</RouterLink>
              </div>
            </div>

            <div>
              <AppButton type="submit" color='success' block :disabled="Object.keys(errors).length != 0" :loading="$register.config.loading">Register</AppButton>
            </div>

        </div>
    </Form>
    </div>
  </div>

</template>

<script setup lang="ts">
import { useRegisterStore } from '@/store/@auth/RegisterStore'
import * as Yup from 'yup'
import { Form, configure, ErrorMessage, Field } from 'vee-validate'

import AppButton from '@/components/form/AppButton.vue'
import AppInput from  '@/components/form/AppInput.vue'
import AppSelect from '@/components/form/AppSelect.vue'

configure({
    validateOnInput: true
})

const $register = useRegisterStore()

const schema = Yup.object({
  picture: Yup.mixed().required('Picture is required'),
  last_name: Yup.string().required('Last name is required'),
  first_name: Yup.string().required('First name is required'),

  position: Yup.string().required('Position is required'),

  mobile: Yup.string().min(13, 'Invalid Number ex: (0997-866-3855)'),
})

const preview = ref(null)

function AddPicture(events) {
  $register.params.picture = events.target.files[0]

  const reader = new FileReader()
  reader.onload = (e) => {
    preview.value = e.target.result
  }
  reader.readAsDataURL($register.params.picture)
}
</script>
