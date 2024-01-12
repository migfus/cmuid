import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGConfig, TGQuery, TGUserRegister,} from "../GlobalType"

const notMountedCalledYet = ref<boolean>(true)

type TParams = {
  picture: string
  user_register_id: string
  id: string
}

const title = `@admin/UploadedSoftCopyStore`
export const useUploadedSoftCopyStore = defineStore(title, () => {
  const content = ref<{ data: TGUserRegister[], total: number }>({ data: [], total: 0 })

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
    form: '',
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
    filter: 'uploaded'
  })

  const params = reactive<TParams>(initParams())

  // SECTION API
  async function GetAPI(page = 1) {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(`/api/file`, {params: {...query, page}})
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
    notMountedCalledYet,

    GetAPI,
    PostAPI,
    RemoveAPI,

    Reset,
    ChangeForm,
  }
});
