import { defineComponent, h, shallowRef  } from "vue"
import { defineStore } from "pinia"

interface pagesInt {
  name: string
  link: { name: string }
}

export const useNavigationStore = defineStore("system/NavigationStore", () => {
  const pages: Array<pagesInt> = [
    {
      name: 'Request for CSC ID',
      link: { name: 'request'},
    },
    {
      name: 'Check Status',
      link: { name: 'status'},
    },
    {
      name: 'Verify',
      link: { name: 'verify'},
    },
  ]
  // BUG
  const social = shallowRef([
    {
      name: 'Facebook',
      href: 'https://www.facebook.com/cmu.hrmo.33',
      icon: defineComponent({
        render: () =>
          h('svg', { fill: 'currentColor', viewBox: '0 0 24 24' }, [
            h('path', {
              'fill-rule': 'evenodd',
              d: 'M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z',
              'clip-rule': 'evenodd',
            }),
          ]),
      }),
    },
  ])


  return {
    pages,
    social,
  }
});
