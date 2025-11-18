<script setup lang="ts">
import TableInformation from '@/components/TableInformation.vue';
import TableSimple from '@/components/TableSimple.vue';
import { useInvoiceStore } from '@/stores/invoice';
import { Button, Modal } from 'ant-design-vue';
import { ColumnType } from 'ant-design-vue/es/table';
import dayjs from 'dayjs';
import { component as VViewer } from 'v-viewer';
import { reactive } from 'vue';

type Props = {
  modal: {
    open: boolean;
    loading: boolean;
    setOpen: () => void;
    submit: () => void;
  };
};

defineProps<Props>();

const invoice = useInvoiceStore();

const invoiceInformation = [
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

const productSummary = reactive({
  dataSource: invoice.items.map((item, index) => ({
    key: `#${index + 1}`,
    product: item.product_name,
    quantity: item.quantity?.toLocaleString('id-ID', {
      maximumFractionDigits: 0,
    }),
    price: item.price?.toLocaleString('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0,
    }),
    discount: item.discount
      ? item.discount_type === 'percentage'
        ? `${item.discount}%`
        : `Rp ${item.discount}`
      : '-',
    total_price: item.total_price?.toLocaleString('id-ID', {
      style: 'currency',
      currency: 'IDR',
      maximumFractionDigits: 0,
    }),
  })),
  columns: [
    { title: 'No', dataIndex: 'key', key: 'key' },
    { title: 'Product', dataIndex: 'product', key: 'product' },
    { title: 'Quantity', dataIndex: 'quantity', key: 'quantity' },
    { title: 'Price', dataIndex: 'price', key: 'price' },
    { title: 'Discount', dataIndex: 'discount', key: 'discount' },
    { title: 'Total Price', dataIndex: 'total_price', key: 'total_price' },
  ] as ColumnType[],
});

const invoiceSummary = reactive({
  dataSource: [
    {
      total_pieces: invoice.total_pieces?.toLocaleString('id-ID', {
        maximumFractionDigits: 0,
      }),
      total_price: invoice.total_price?.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
      }),
      uploadDate: dayjs(invoice.created_at).format('YYYY-MM-DD'),
      date: invoice.date,
      name: invoice.name,
    },
  ],
  columns: [
    { title: 'Total Pieces', dataIndex: 'total_pieces' },
    { title: 'Total Price', dataIndex: 'total_price' },
    { title: 'Upload Date', dataIndex: 'uploadDate' },
    { title: 'Invoice Date', dataIndex: 'date' },
    // { title: 'EU Name', dataIndex: 'name' },
  ] as ColumnType[],
});
</script>

<template>
  <Modal
    class="top-4! w-3/4!"
    v-model:open="modal.open"
    title="Verification Summary"
    :mask-closable="false"
    :closable="false"
    @ok="modal.submit"
  >
    <div class="space-y-5">
      <div class="flex justify-between space-x-5">
        <div class="flex grow">
          <div class="relative w-[560px]">
            <v-viewer
              class="mx-auto h-fit max-h-[360px] min-h-[360px] w-fit max-w-[480px] grow overflow-clip border-4 border-gray-200"
              :options="{ inline: true, navbar: false }"
            >
              <img
                v-if="modal.open"
                :key="invoice.image"
                :src="invoice.image"
                hidden
              />
            </v-viewer>
          </div>
        </div>
        <div class="flex grow">
          <TableInformation
            title="Invoice Information"
            :data-source="invoiceInformation"
          />
        </div>
      </div>
      <div class="space-y-5">
        <TableSimple
          :data-source="productSummary.dataSource"
          :columns="productSummary.columns"
          :pagination="false"
        />
        <div class="flex justify-end">
          <TableSimple
            class="basis-3/5"
            :data-source="invoiceSummary.dataSource"
            :columns="invoiceSummary.columns"
            :pagination="false"
          />
        </div>
      </div>
    </div>
    <template #footer>
      <div class="mt-5 flex gap-5">
        <div class="flex items-center">
          Are you sure to accept this invoice?
        </div>
        <div class="flex grow justify-end space-x-2">
          <Button @click="modal.setOpen" :disabled="modal.loading">
            Cancel
          </Button>
          <Button
            type="primary"
            @click="modal.submit"
            :loading="modal.loading"
            :disabled="modal.loading"
          >
            Accept
          </Button>
        </div>
      </div>
    </template>
  </Modal>
</template>
