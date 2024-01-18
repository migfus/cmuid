import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGUserRegister, TGStatus } from "../GlobalType"

type TParams = {
  status: TGStatus[]
  info: TGUserRegister
}

const title = `public/StatusPublicStore`
const base_url = `/api/public/status`
export const useStatusPublicStore = defineStore(title, () => {
  const content = ref<TParams>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function ShowAPI(id: string) {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(`${base_url}/${id}`)
      console.log('RegisterAPI', data)
      content.value = data

      if(content.value.status.length <= 0) {
        notify({
          group: "error",
          title: "Invalid CSC ID",
          text: 'The CSC-ID may not exist.'
        }, 5000)
        // @ts-ignore
        this.router.push('/status');
      }
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
    config.contentLoading = false
  }


  return {
    config,
    content,

    ShowAPI,
  }
});
