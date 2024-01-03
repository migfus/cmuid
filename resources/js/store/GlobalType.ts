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

export type TGUserRegister = {
  id: string
  picture: string
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
}

export type TGStatus = {
  id: number,
  user_register_id: number
  user_register: {
    picture: string
    last_name: string
    first_name: string
    mid_name?: string
    ext_name?: string
  }
  user_id?: number
  user: {
    email: string
    avatar: string
  }
  category: {
    name: string
  }
  content?: string
  created_at: Date
}

export type TGAuth = {
  id: number
  email: string
  // password: string
  avatar: string
  created_at: string
}

export type TGDevice = {
  id: string // NOTE token
  name: string
  platform: string
  last_response: string
}
