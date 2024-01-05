import { ref, reactive } from "vue"
import { defineStore } from "pinia"
import axios from "axios"
import { notify } from 'notiwind'
import type { TGQuery, TGUserRegister, TGConfig } from "../GlobalType"
import moment from 'moment'

type TParams = {
  id: string
  name: string
  content: string
  sms: string
  sendSMS: boolean
}

const title = `@admin/RequestStore`
export const useRequestStore = defineStore(title, () => {
  const content = ref<TGUserRegister[]>(null)

  const config = reactive<TGConfig>({
    buttonLoading: false,
    contentLoading: false,
    form: ''
  })

  const query = reactive<TGQuery>({
    search: '',
    sort: 'DESC',
    filter: 'request',
  })

  const params = reactive<TParams>(InitParams())

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
      let { data: { data }} = await axios.put(`/api/request/${params.id}`, {form: config.form, ...params})
      GetAPI()
      ChangeForm(null, '')
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

  // SECTION FUNC
  function InitParams() {
    return {
      id: null,
      name: null,
      content: '<p>Content of the editor.</p>',
      sms: '',
      sendSMS: true,
    }
  }

  function ChangeFeedbackText(form: string, row:TGUserRegister) {
    let name = `${row.last_name}, ${row.first_name} ${row.mid_name ? row.mid_name + '. ' : ''} ${row.ext_name ? row.ext_name + '. ' : ''}`
    const title = `Hello,\n`
    const footer = `\nFrom the CSC ID System (OHRM).`
    let doneMessage =`<p>Your <strong>CSC ID</strong> is successfully processed. You can now claim to <strong>OHRM</strong>.</p>\n<p>You can verify using <a href="https://id.migfus.net/verify/${row.id}">https://id.migfus.net/verify/${row.id}</a><p>`
    let doneSms = `${title}Your CSC ID is successfully processed. You can now claim to Office of Human Resource Management. ${footer}`


    if(row.claim_type_id == 2) {
      doneMessage = `<p>Your <strong>CSC ID</strong> is successfully processed. You can now get the soft-copy provided link below.\n https://id.migfus.net/verify/${row.id}</p>`
      doneSms = `${title}Your CSC ID is good to go! Grab your soft-copy to website verification or status using [cscid_${row.id}]\n${footer}`
    }

    switch(form) {
      case 'feedback':
        params.content = '<p>[Feedback Here]</p>'
        params.sms = `${title}[Feedback Here].${footer}`
        break;
      case 'complete':
        params.content = doneMessage
        params.sms = doneSms
        break;
      case 'cancel':
        params.content = "<p>Unfortunate the photo you submitted is <strong>unrecognizable</strong>. It may cause some issue upon making CSC ID for this issue.</p>"
        params.sms = `${title}Unfortunate the photo you submitted is unrecognizable may cause some issue upon making CSC ID for this issue.${footer}`
        break;
      case 'claim':
        params.content = "<p>Your CSC ID has been Claimed by: [name]</p>"
        params.sms = `${title}Your CSC ID has been Claimed by: [name].${footer}`
        break;
      default:
        params.content = ''
        config.form = ''
    }
  }

  function ChangeForm(row?:TGUserRegister, formType = '') {
    config.form = formType

    if(!formType) {
      Object.assign(params, InitParams())
    }
    else {
      ChangeFeedbackText(formType, row)
      params.id = row.id
    }
  }


  return {
    config,
    content,
    query,
    params,

    GetAPI,
    FeedbackAPI,

    ChangeForm
  }
});
