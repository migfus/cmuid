import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGDevice, TGQuery,} from "../GlobalType"

type TParams = {

}

const title = `@admin/DeviceStore`
export const useDeviceStore = defineStore(title, () => {
  const content = ref<TGDevice[]>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
  })

  const params = reactive<TParams>({

  })

  // SECTION API
  async function GetAPI() {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(`/api/device`, {params: query})
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
    query,
    params,

    GetAPI,
  }
});
