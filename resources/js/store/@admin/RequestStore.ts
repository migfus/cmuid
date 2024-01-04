import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGQuery, TGUserRegister } from "../GlobalType"
import moment from 'moment'

type TParams = {
  id: string
  name: string
  content: string
  sms: string
  sendSMS: boolean
}
type TConfig = {
  buttonLoading: boolean
  contentLoading: boolean
  show: string
}

const title = `@admin/RequestStore`
export const useRequestStore = defineStore(title, () => {
  const content = ref<TGUserRegister[]>(null)

  const config = reactive<TConfig>({
    buttonLoading: false,
    contentLoading: false,
    show: ''
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
    filter: 'request',
  })

  const params = reactive<TParams>({
    id: null,
    name: null,
    content: '<p>Content of the editor.</p>',
    sms: '',
    sendSMS: true,
  })

  // SECTION API
  async function GetAPI() {
    config.contentLoading = true
    try{
      let { data: { data }} = await axios.get(`/api/request`, {params: query})
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

  async function FeedbackAPI() {
    config.buttonLoading = true
    try{
      let { data: { data }} = await axios.put(`/api/request/${params.id}`, {type: config.show, ...params})
      GetAPI()
    }
    catch(e) {
      notify({
        group: "error",
        title: "Server Error",
        text: 'The server is doing something unnecessary.'
      }, 5000)
    }
    config.buttonLoading = false
  }


  function ShowChange(value: string, name = '') {
    config.show = value
    params.name = name
    const footer = `\nFrom the CSC ID System (OHRM),\n${moment().format('MMM DD, YYYY hh:mm A')}`
    const title = `Hello ${name},\n`

    switch(value) {
      case 'Feedback':
        params.content = '<p>Feedback Here</p>'
        params.sms = `${title}SMS Notification feedback here.${footer}`
        break;
      case 'Done':
        params.content = '<p>Your <strong>CSC ID</strong> is successfully processed. You can now claim to <strong>OHRM</strong>.</p>'
        params.sms = `${title}Your CSC ID is successfully processed. You can now claim to Office of Human Resource Management.
          You can verify the CSC ID using https://id.migfus.net/verify.
        ${footer}`
        break;
      case 'Cancel':
        params.content = "<p>Unfortunate the photo you submitted is <strong>unrecognizable</strong>. It may cause some issue upon making CSC ID for this issue.</p>"
        params.sms = `${title}Unfortunate the photo you submitted is unrecognizable may cause some issue upon making CSC ID for this issue.${footer}`
        break;
      case 'Claimed':
        params.content = "<p>Your CSC ID has been Claimed by: </p>"
        params.sms = `${title}Your CSC ID has been Claimed by: .${footer}`
        break;
      default:
        params.content = ''
        config.show = ''
    }
  }


  return {
    config,
    content,
    query,
    params,

    GetAPI,
    FeedbackAPI,

    ShowChange
  }
});
