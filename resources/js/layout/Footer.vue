<template>
  <footer class="bg-white" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div :class="[$props.sideBar ? 'max-w-full' : 'max-w-7xl ', 'mx-auto px-6 pb-8 pt-12 sm:pt-24 lg:px-8 lg:pt-12']">
      <div class="xl:grid xl:grid-cols-3 xl:gap-4">
        <div class="space-y-6">
          <object class="h-48 mb-4" data="/images/logo-anim.svg" alt="Company name" />
          <a href="https://maps.app.goo.gl/Pyp6oks9RvfraMvM6" target="_blank" class="text-sm leading-6 text-gray-600 mt-0 font-bold">OHRM, Admin. Bldg., CMU, Musuan, Maramag, Bukidnon</a>
          <p class="text-sm leading-6 text-gray-600 mt-0" style="margin-top: 0px">Email: <a href="mailto:hrmo@cmu.edu.ph" class="font-bold">hrmo@cmu.edu.ph</a></p>
          <div class="flex space-x-6">
            <a v-for="item in $nav.social" :key="item.name" :href="item.href" target="_blank" class="text-gray-400 hover:text-gray-500">
              <span class="sr-only">{{ item.name }}</span>
              <component :is="item.icon" class="h-8 w-8" aria-hidden="true" />
            </a>
          </div>
        </div>
        <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Pages</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in navigation.pages" :key="`${item.name}`">
                  <RouterLink :to="{ name: item.link.name }" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</RouterLink>
                </li>
              </ul>
            </div>
            <div class="mt-10 md:mt-0">
              <h3 class="text-sm font-semibold leading-6 text-gray-900">FAQs</h3>
              <ul role="list" class="mt-6 space-y-4">
                <!-- <li v-for="row in $faqs.content" :key="row.id" class="truncate">
                  <RouterLink to="/faqs" class="text-sm leading-6 text-gray-600 hover:text-gray-900 text-ellipsis">{{ row.question }}</RouterLink>
                </li> -->
              </ul>
            </div>
          </div>
          <div class="md:grid md:grid-cols-2 md:gap-8">
            <div>
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Posts</h3>
              <ul role="list" class="mt-6 space-y-4">
                <!-- <li v-for="row in $posts.content" :key="`${row.id}`" class="truncate">
                  <RouterLink :to="`/posts/${row.id}`" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ row.title }}</RouterLink>
                </li> -->
              </ul>
            </div>
            <div class="mt-10 md:mt-0">
              <h3 class="text-sm font-semibold leading-6 text-gray-900">Others</h3>
              <ul role="list" class="mt-6 space-y-4">
                <li v-for="item in navigation.others" :key="item.name">
                  <RouterLink :to="{ name: item.href }" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ item.name }}</RouterLink>
                </li>
                <li>
                  <a href="https://trello.com/b/j06zEFhY/csc-id" targe="_blank" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Development 0.0.3</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-8 border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-8">
        <p class="text-xs leading-5 text-gray-500">&copy; 2024 Office of Human Resource Management (OHRM) | Central Mindanao University (CMU).</p>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { useNavigationStore } from '@/store/system/NavigationStore'

const $nav =   useNavigationStore()

const $props = defineProps({
  sideBar: {
    default: false,
    type: Boolean,
  }
})

const navigation = {
  pages: $nav.pages,
  support: [
    // { name: 'Pricing', href: '#' },
    // { name: 'Documentation', href: '#' },
    // { name: 'Guides', href: '#' },
    // { name: 'API Status', href: '#' },
  ],
  company: [
    // { name: 'About', href: '#' },
    // { name: 'Blog', href: '#' },
    // { name: 'Jobs', href: '#' },
    // { name: 'Press', href: '#' },
    // { name: 'Partners', href: '#' },
  ],
  others: [
    // { name: 'Terms & Agreement', href: 'terms-agreement' },
    // { name: 'Sitemap', href: 'sitemap' },
  ],
};
</script>
