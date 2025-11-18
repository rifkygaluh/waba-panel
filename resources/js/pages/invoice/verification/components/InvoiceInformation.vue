<script setup lang="ts">
import TableInformation from '@/components/TableInformation.vue';
import { useInvoiceStore } from '@/stores/invoice';
import dayjs from 'dayjs';
import { component as VViewer } from 'v-viewer';

const invoice = useInvoiceStore();

const dataSource = [
  { title: 'Invoice Number', value: invoice.invoice_number },
  { title: 'Store Name', value: invoice.store.name },
  { title: 'Store Code', value: invoice.store.code },
  { title: 'Store Area', value: invoice.store.area },
  { title: 'User Name', value: invoice.user.name },
  { title: 'User Email', value: invoice.user.email },
  { title: 'User Phone', value: invoice.user.phone_number },
  { title: 'User Address', value: invoice.user.address },
  {
    title: 'Upload Date',
    value: dayjs(invoice.created_at).format('DD-MM-YYYY'),
  },
];
</script>

<template>
  <div class="grid grid-cols-2 gap-6">
    <div>
      <v-viewer
        class="min-h-[400px] bg-gray-50"
        :options="{ inline: true, navbar: false }"
      >
        <img :key="invoice.image" :src="invoice.image" hidden />
      </v-viewer>
    </div>
    <div class="relative">
      <TableInformation title="Invoice Information" :data-source="dataSource" />
    </div>
  </div>
</template>
