<script setup lang="ts">
import TableFetcher from '@/components/TableFetcher.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { history } from '@/routes/invoice';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { columns, queryData } from './api';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Invoice',
  },
  {
    title: 'History',
    href: history().url,
  },
];
</script>

<template>
  <Head title="Invoice History" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <h1 class="text-2xl">Invoice History</h1>
      </Card>
      <Card class="px-6">
        <TableFetcher :query-data="queryData" :columns="columns" />
      </Card>
    </div>
  </AppLayout>
</template>
