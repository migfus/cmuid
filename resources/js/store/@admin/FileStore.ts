import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGQuery, TGUserRegister,} from "../GlobalType"

type TParams = {
  picture: string
  user_register_id: string
  id: string
}

const title = `@admin/FileStore`
export const useFileStore = defineStore(title, () => {
  const content = ref<TGUserRegister[]>([])

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
    form: '',
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
    filter: 'yawa'
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
      let { data: { data }} = await axios.post(
        `/api/file`,
        params,
        { headers: { 'Content-Type': 'multipart/form-data' } }
      )
      ChangeForm(null, null)
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

  async function RemoveAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.delete(`/api/file/${params.id}`)
      ChangeForm(null, null)
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

  function ChangeForm(row?: TGUserRegister , formMode = null) {
    if(formMode == 'create') {
      config.form = 'create'
      params.user_register_id = row.id
    }
    else if (formMode == 'remove') {
      params.id = row.files[0].id
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
      picture: null,
      user_register_id: null,
      id: null
    }
  }



  return {
    config,
    content,
    query,
    params,

    GetAPI,
    PostAPI,
    RemoveAPI,

    Reset,
    ChangeForm,
  }
});
