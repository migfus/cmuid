import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig } from "../GlobalType"

const title = `dashboard/RequestingStatisticsDashboardStore`
const base_url = `/api/dashboard/requesting-statistics`
export const useRequestingStatisticsDashboardStore = defineStore(title, () => {
  const content = ref<{
    requesting: number
    completed: number
    canceled: number
    claimed: number
    upload: number
  }>({
    requesting: 0,
    completed: 0,
    canceled: 0,
    claimed: 0,
    upload: 0
  })

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  // SECTION API
  async function GetAPI() {
    config.contentLoading = true
    try  {
      let { data: { data }} = await axios.get(base_url)
      content.value = data
    }
    catch(e) {
      if(e.response.data.message != 'Invalid Input') {
        notify({
          group: "error",
          title: "Server Error",
          text: 'The server is doing something unnecessary.'
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
