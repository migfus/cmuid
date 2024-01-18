import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGDevice, TGQuery,} from "../GlobalType"
import { idGenerator } from "@/helpers/Converter"

type TParams = {
  qr: {
    link: string
    id: string
  },
  id: string
}

const title = `dashboard/DeviceDashboardStore`
const base_url = `/api/dashboard/device`
export const useDeviceDashboardStore = defineStore(title, () => {
  const content = ref<TGDevice[]>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
    form: '',
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
  })

  const params = reactive<TParams>(initParams())

  // SECTION API
  async function GetAPI() {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(base_url, {params: query})
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
    params.id = idGenerator()
  }

  async function PostAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post(base_url, params)
      content.value = data
      GetAPI()
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
    config.buttonLoading = false
  }

  async function DestroyAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.delete(`${base_url}/${params.id}`)
      content.value = data
      GetAPI()
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
    config.buttonLoading = false
  }

  function Reset() {
    config.form = ''
    Object.assign(params, initParams())
  }

  function initParams() {
    return {
      qr: {
        id: idGenerator(),
        link: window.location.origin
      },
      id: '',
    }
  }

  return {
    config,
    content,
    query,
    params,

    GetAPI,
    PostAPI,
    DestroyAPI,

    Reset
  }
});
