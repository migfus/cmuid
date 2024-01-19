import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGClaimType } from "../GlobalType"

const title = `public/ClaimTypeStore`
const base_url = `/api/public/claim-type`
export const useClaimTypePublicStore = defineStore(title, () => {
  const content = ref<TGClaimType[]>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function GetAPI() {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(base_url)
      content.value = data
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

    GetAPI,
  }
});
