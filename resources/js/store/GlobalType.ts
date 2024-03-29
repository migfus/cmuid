export type TGConfig = {
  contentLoading: boolean
  buttonLoading: boolean
  form?: string
}

export type TGQuery = {
  search: string
  filter?: string
  sort: 'ASC' | 'DESC'
  start?: Date
  end?: Date
}

export type TGRequesting = {
  id: string
  picture: string
  thumbnail: string
  last_name: string
  first_name: string
  mid_name?: string
  ext_name?: string
  position: string
  department?: string
  unit?: string
  mobile: number
  email?: string
  created_at: Date
  claim_type_id: number

  files?: TGFile[]
  claim_type: TGClaimType
  status_category: TGStatusCategory
}

export type TGStatusCategory = {
  name: string
}

export type TGClaimType = {
  id: string
  name: string
  description: string
  features: string
  icon: string
}

export type TGStatus = {
  id: number,
  requesting_id: string
  requesting: TGRequesting
  user_id?: number
  user: {
    email: string
    avatar: string
  }
  status_category: {
    name: string
  }
  content?: string
  created_at: Date
}

export type TGAuth = {
  id: number
  email: string
  avatar: string
  created_at: string
}

export type TGDevice = {
  id: string // NOTE token
  name: string
  platform: string
  last_response: string
}

export type TGFile = {
  id: string
  requesting_id: string
  name: string
  url: string
  created_at: Date
}
