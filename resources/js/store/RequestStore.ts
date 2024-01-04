import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGUserRegister } from "./GlobalType"


const title = `RequestStore`
export const useRequestStore = defineStore(title, () => {

  const params = reactive<TGUserRegister>(ResetParams())

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function RegisterAPI(type: string) {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post(
        '/api/user-register', {...params, type: type},
        { headers: { 'Content-Type': 'multipart/form-data' } }
      )
      Object.assign(params, ResetParams())

      notify({
        group: "success",
        title: "Registration Successful",
        text: 'You can now wait for any updates.'
      }, 5000)

      // @ts-ignore
      this.router.push({ name: 'status-show', params: { id: data }})
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Invalid Credentials",
          text: 'Mistyped? Please try again.'
        }, 5000)
      }
    }
    config.buttonLoading = false
  }

  function ProceedToConfirm() {
    // @ts-ignore
    this.router.push({ name: 'confirm-request'})
  }

  function ResetParams() {
    return {
      id: null,
      created_at: null,
      last_name: null,
      first_name: null,
      mid_name: null,
      ext_name: '',
      department: null,
      unit: null,
      email: null,
      mobile: null,
      position: null,
      picture: null,
    }
  }

  return {
    params,
    config,

    RegisterAPI,
    ProceedToConfirm,
  }
});
