<script setup lang="ts">
import TableVertical from '@/components/TableVertical.vue';
import { useInvoiceStore } from '@/stores/invoice';
import { component as VViewer } from 'v-viewer';

const invoice = useInvoiceStore();

const dataSource = [
  { title: 'Invoice ID', value: invoice.id },
  { title: 'Store Name', value: invoice.storeName },
  { title: 'Store Owner', value: invoice.storeOwner },
  { title: 'Store Phone', value: invoice.storePhone },
  { title: 'Store Address', value: invoice.storeAddress },
  { title: 'Upload Date', value: invoice.uploadDate },
];
</script>

<template>
  <div class="grid grid-cols-2 gap-6">
    <div>
      <v-viewer class="min-h-[440px]" :options="{ inline: true }">
        <img
          :key="invoice.image"
          :src="invoice.image"
          hidden
        />
      </v-viewer>
    </div>
    <div class="relative">
      <TableVertical title="Invoice Information" :data-source="dataSource" />
    </div>
  </div>
</template>
