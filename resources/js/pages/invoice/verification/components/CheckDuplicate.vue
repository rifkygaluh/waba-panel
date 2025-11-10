<script setup lang="ts">
import TableFetcher from '@/components/TableFetcher.vue';
import {
  columns,
  queryData,
} from '@/pages/invoice/verification/api/CheckDuplicate';
import { useInvoiceStore } from '@/stores/invoice';
import { Button } from 'ant-design-vue';
import { Eye } from 'lucide-vue-next';
import { reactive } from 'vue';
import { accept } from '../api/FormSubmission';
import ModalDuplicate from './modals/ModalDuplicate.vue';
import ModalSummary from './modals/ModalSummary.vue';

const invoice = useInvoiceStore();

const duplicateModal = reactive({
  record: null,
  open: false,
  loading: false,
  setOpen: (record: any) => {
    duplicateModal.open = !duplicateModal.open;
    duplicateModal.record = duplicateModal.open ? record : null;
  },
});

const summaryModal = reactive({
  open: false,
  loading: false,
  setOpen: () => {
    summaryModal.open = !summaryModal.open;
  },
  submit: async () => {
    summaryModal.loading = true;
    await accept(invoice);
    summaryModal.loading = false;
    summaryModal.open = false;
  },
});

const payload = reactive({
  id: invoice.id,
  total_pieces: invoice.total_pieces,
  amount: invoice.total_price,
  date: invoice.date,
  search: invoice.checkDuplicate.search,
});
</script>

<template>
  <div id="check-duplicate" class="flex justify-between">
    <h2 class="text-xl">Check for Possible Duplicate</h2>
    <div>
      <!-- <InputSearch
        class="flex items-center"
        placeholder="Search for EU Names"
        v-model:value="invoice.checkDuplicate.search"
      /> -->
    </div>
  </div>
  <TableFetcher
    :query-data="(params) => queryData(params, payload)"
    :columns="columns"
    :pagination="5"
  >
    <template #action="{ record }">
      <Button class="px-2.5!" @click="duplicateModal.setOpen(record)">
        <Eye class="h-4 w-4" />
      </Button>
    </template>
  </TableFetcher>
  <div class="flex justify-end">
    <Button type="primary" @click="summaryModal.setOpen">
      Accept Invoice
    </Button>
  </div>
  <ModalDuplicate :modal="duplicateModal" />
  <ModalSummary :modal="summaryModal" />
</template>
