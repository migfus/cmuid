export const FullName = (name: { last_name: string, first_name: string, mid_name?: string, ext_name?: string}) => {
  return `${name.last_name}, ${name.first_name} ${name.mid_name ? `${name.mid_name}.` : ''} ${name.ext_name ? `${name.ext_name}.` : ''}`
}

export const MobileFormat = (value: number) => {
  return value.toString().replace(/(\d{3})(\d{3})(\d{4})/, '0$1-$2-$3');
}

export const idGenerator = (length = 5) => {
  let result = '';
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  const charactersLength = characters.length;
  let counter = 0;
  while (counter < length) {
    result += characters.charAt(Math.floor(Math.random() * charactersLength));
    counter += 1;
  }
  return result;
}
