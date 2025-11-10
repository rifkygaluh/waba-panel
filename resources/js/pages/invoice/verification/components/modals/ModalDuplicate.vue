<script setup lang="ts">
import TableInformation from '@/components/TableInformation.vue';
import { doubleViewersGuard } from '@/lib/utils';
import { useInvoiceStore } from '@/stores/invoice';
import { Modal } from 'ant-design-vue';
import dayjs from 'dayjs';
import { component as VViewer } from 'v-viewer';
import { watch } from 'vue';

type Props = {
  modal: {
    record: any;
    open: boolean;
    setOpen: (record: any) => void;
  };
};

const props = defineProps<Props>();

const invoice = useInvoiceStore();

const dataSource = (data: any) => [
  { title: 'Invoice Number', value: data.invoice_number },
  {
    title: 'Store Name',
    value: data.store ? data.store.name : data.store_name,
  },
  {
    title: 'Store Code',
    value: data.store ? data.store.code : data.store_code,
  },
  {
    title: 'Store Area',
    value: data.store ? data.store.area : data.store_area,
  },
  { title: 'User Name', value: data.user ? data.user.name : data.user_name },
  { title: 'User Email', value: data.user ? data.user.email : data.user_email },
  {
    title: 'User Phone',
    value: data.user ? data.user.phone_number : data.user_phone_number,
  },
  {
    title: 'User Address',
    value: data.user ? data.user.address : data.user_address,
  },
  {
    title: 'Upload Date',
    value: dayjs(data.created_at).format('DD-MM-YYYY'),
  },
];

watch(props.modal, () => {
  doubleViewersGuard('original-invoices');
  doubleViewersGuard('target-invoices');
});
</script>

<template>
  <Modal
    class="top-4! w-full! 2xl:w-3/4!"
    v-model:open="modal.open"
    title="Possible Duplicate"
    :footer="null"
  >
    <div class="py-8">
      <div class="flex justify-center space-x-5">
        <div id="original-invoices" class="relative w-[560px]">
          <v-viewer
            class="mx-auto h-fit max-h-[360px] min-h-[360px] w-fit max-w-[480px] grow overflow-clip border-4 border-gray-200"
            :options="{ inline: true, navbar: false }"
          >
            <img
              v-if="modal.open"
              key="original-invoice"
              :src="invoice.image"
              hidden
            />
          </v-viewer>
        </div>
        <div id="target-invoices" class="relative w-[560px]">
          <v-viewer
            class="mx-auto h-fit max-h-[360px] min-h-[360px] w-fit max-w-[480px] grow overflow-clip border-4 border-gray-200"
            :options="{ inline: true, navbar: false }"
          >
            <img key="target-invoice" :src="modal.record.image" hidden />
          </v-viewer>
        </div>
      </div>
      <div class="mt-8 flex justify-center space-x-5">
        <div class="w-[560px]">
          <TableInformation
            title="Original Invoice"
            :data-source="dataSource(invoice)"
          />
        </div>
        <div class="w-[560px]">
          <TableInformation
            title="Target Invoice"
            :data-source="dataSource(modal.record)"
          />
        </div>
      </div>
    </div>
  </Modal>
</template>
