<script setup lang="ts">
import TableFetcher from '@/components/TableFetcher.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import product from '@/routes/product';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Button, Modal } from 'ant-design-vue';
import { PencilLine, PlusCircle, Trash2 } from 'lucide-vue-next';
import { reactive } from 'vue';
import { columns, queryData } from './api';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Products',
    href: product.index().url,
  },
];

const deleteModal = reactive({
  record: null as { name: string } | null,
  open: false,
  setOpen: (data: { name: string }) => {
    deleteModal.open = !deleteModal.open;
    deleteModal.record = deleteModal.open ? data : null;
  },
});
</script>

<template>
  <Head title="Products" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <div class="flex justify-between">
          <h1 class="text-2xl">Products</h1>
          <div>
            <Link :href="product.create().url">
              <Button type="primary">
                <template #icon>
                  <PlusCircle class="h-4 w-4" />
                </template>
                Add Product
              </Button>
            </Link>
          </div>
        </div>
      </Card>
      <Card class="px-6">
        <TableFetcher :query-data="queryData" :columns="columns">
          <template #action="{ record }">
            <div class="flex gap-2.5">
              <Link :href="product.edit(record.id).url">
                <Button class="px-2.5!">
                  <PencilLine class="h-4 w-4" />
                </Button>
              </Link>
              <Button
                class="px-2.5!"
                @click="deleteModal.setOpen({ name: record.name })"
                danger
              >
                <Trash2 class="h-4 w-4" />
              </Button>
            </div>
          </template>
        </TableFetcher>
        <Modal
          class="w-fit!"
          v-model:open="deleteModal.open"
          :closable="false"
          :ok-button-props="{ danger: true }"
          ok-text="Confirm"
        >
          Are you sure to delete this data, {{ deleteModal.record?.name }}?
        </Modal>
      </Card>
    </div>
  </AppLayout>
</template>
