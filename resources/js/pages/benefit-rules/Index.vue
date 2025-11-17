<script setup lang="ts">
import TableFetcher from '@/components/TableFetcher.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import benefitRules from '@/routes/benefit-rules';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from 'ant-design-vue';
import { Pen, PlusCircle, Trash2 } from 'lucide-vue-next';
import { reactive } from 'vue';
import { columns, queryData } from './api/Index';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Benefit Rules',
    href: benefitRules.index().url,
  },
];

const createModal = reactive({
  open: false,
  setOpen: () => {
    createModal.open = !createModal.open;
  },
});
</script>

<template>
  <Head title="Benefit Rules" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <div class="flex justify-between">
          <h1 class="text-2xl">Benefit Rules</h1>
          <div>
            <Link :href="benefitRules.create().url">
              <Button type="primary" @click="createModal.setOpen">
                <template #icon>
                  <PlusCircle class="h-4 w-4" />
                </template>
                New Rule
              </Button>
            </Link>
          </div>
        </div>
      </Card>
      <Card class="px-6">
        <TableFetcher :query-data="queryData" :columns="columns">
          <template #action="{ record }">
            <div class="flex gap-2.5">
              <Link :href="benefitRules.edit(record.id).url">
                <Button class="px-2.5!">
                  <Pen class="h-4 w-4" />
                </Button>
              </Link>
              <Button class="px-2.5!" danger disabled>
                <Trash2 class="h-4 w-4" />
              </Button>
            </div>
          </template>
        </TableFetcher>
      </Card>
    </div>
  </AppLayout>
</template>
