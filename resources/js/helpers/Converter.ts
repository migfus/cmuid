export const FullName = (name: { last_name: string, first_name: string, mid_name?: string, ext_name?: string}) => {
  return `${name.last_name}, ${name.first_name} ${name.mid_name ?? ''} ${name.ext_name ?? ''}`
}
