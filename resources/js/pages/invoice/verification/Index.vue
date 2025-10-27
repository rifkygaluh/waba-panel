<script setup lang="ts">
import TableFetcher from '@/components/TableFetcher.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import verification from '@/routes/invoice/verification';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Button } from 'ant-design-vue';
import { FileSearch2 } from 'lucide-vue-next';
import { columns, queryData } from './api/Index';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Invoice',
  },
  {
    title: 'Verification',
    href: verification.index().url,
  },
];
</script>

<template>
  <Head title="Invoice Verification" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <h1 class="text-2xl">Invoice Verification</h1>
      </Card>
      <Card class="px-6">
        <TableFetcher :query-data="queryData" :columns="columns">
          <template #action="{ index }">
            <Link :href="`/${index + 1}`">
              <Button class="px-2.5!" type="primary">
                <FileSearch2 class="h-4 w-4" />
              </Button>
            </Link>
          </template>
        </TableFetcher>
      </Card>
    </div>
  </AppLayout>
</template>
