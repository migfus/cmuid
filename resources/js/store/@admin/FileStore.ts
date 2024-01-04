import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGDevice, TGQuery,} from "../GlobalType"
import { idGenerator } from "@/helpers/Converter"

type TParams = {
  user_register_id: string
}

type TContent = {
  id: number
  last_name: string
  first_name: string
  mid_name: string
  ext_name: string

  position: string
  department: string
  unit: string

  mobile: number
  email: string

  picture: string
  created_at: Date
}

const title = `@admin/FileStore`
export const useFileStore = defineStore(title, () => {
  const content = ref<TContent[]>([])

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
      let { data: { data }} = await axios.get(`/api/file`, {params: query})
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

  async function PostAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.post(`/api/device`, {params: query})
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
    config.buttonLoading = false
  }

  function ChangeForm(row?: TContent , formMode = null) {
    if(formMode == 'create') {
      config.form = 'create'
    }
    else {
      config.form = ''
      Object.assign(params, initParams())
    }
  }

  function Reset() {
    config.form = ''
    Object.assign(params, initParams())
  }

  function initParams() {
    return {
      user_register_id: null,
    }
  }



  return {
    config,
    content,
    query,
    params,

    GetAPI,
    PostAPI,

    Reset,
    ChangeForm,
  }
});
