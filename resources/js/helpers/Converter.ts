export const FullName = (name: { last_name: string, first_name: string, mid_name?: string, ext_name?: string}) => {
  return `${name.last_name}, ${name.first_name} ${name.mid_name ? `${name.mid_name}.` : ''} ${name.ext_name ? `${name.ext_name}.` : ''}`
}

export const MobileFormat = (value: number) => {
  return value.toString().replace(/(\d{3})(\d{3})(\d{4})/, '0$1-$2-$3');
}
