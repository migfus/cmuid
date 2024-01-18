import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGUserRegister } from "../GlobalType"

const title = `public/VerifyPublicStore`
const base_url = `/api/public/verify`
export const useVerifyPublicStore = defineStore(title, () => {
  const content = ref<TGUserRegister>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function ShowAPI(id: string) {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(`${base_url}/${id}`)
      content.value = data

      if(!content.value) {
        notify({
          group: "error",
          title: "Invalid CSC ID",
          text: 'This may Unverified CSC ID.'
        }, 5000)
        // @ts-ignore
        this.router.push('/verify');
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
