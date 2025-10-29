<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import productRoute from '@/routes/product';
import { useProductStore } from '@/stores/product';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Button } from 'ant-design-vue';
import ProductForm from './components/ProductForm.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Product',
    href: productRoute.index().url,
  },
  {
    title: 'Create',
  },
];

const product = useProductStore();
</script>

<template>
  <Head title="Product" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <h1 class="text-xl">Insert your product here!</h1>
      </Card>
      <Card class="px-6">
        <ProductForm :product="product" />
        <div class="mt-5 flex justify-end">
          <Button type="primary">Save</Button>
        </div>
      </Card>
    </div>
  </AppLayout>
</template>
