<template>
  <div>
    <Layout>
      <div class="divide-y divide-gray-200 lg:col-span-9">
        <!-- SECTION FORMS -->
        <FormCard />

        <!-- SECTION CONTENT -->
        <ContentCard />
      </div>
  </Layout>
</div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useRequestStore } from '@/store/@admin/RequestStore'

import Layout from    './~Components/Layout.vue'
import ContentCard from './~Components/ContentCard.vue'
import FormCard from './~Components/FormCard.vue'

const $req = useRequestStore()

onMounted(() => {
  $req.query.filter = 'claimed'
  $req.GetAPI()
})
</script>
