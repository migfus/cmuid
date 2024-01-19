import { reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGUserRegister } from "../GlobalType"


const title = `public/RequestPublicStore`
const base_url = '/api/public/requesting'
export const useRequestPublicStore = defineStore(title, () => {

  const params = reactive<TGUserRegister>(ResetParams())

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function RegisterAPI(claim_type_id: string) {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post(
        base_url, {...params, claim_type_id: claim_type_id},
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
      picture: null,
      thumbnail: null,
      last_name: null,
      first_name: null,
      mid_name: null,
      ext_name: null,
      position: null,
      department: null,
      unit: null,
      mobile: null,
      email: null,
      created_at: null,
      claim_type_id: null,

      files: null,
      claim_type: null,
      status_category: null,
    }
  }

  return {
    params,
    config,

    RegisterAPI,
    ProceedToConfirm,
  }
});
