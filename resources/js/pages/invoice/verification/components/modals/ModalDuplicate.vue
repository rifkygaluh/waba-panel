<script setup lang="ts">
import TableInformation from '@/components/TableInformation.vue';
import { doubleViewersGuard } from '@/lib/utils';
import { useInvoiceStore } from '@/stores/invoice';
import { Modal } from 'ant-design-vue';
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
  { title: 'Invoice ID', value: data.id },
  { title: 'Store Name', value: data.storeName },
  { title: 'Store Owner', value: data.storeOwner },
  { title: 'Store Phone', value: data.storePhone },
  { title: 'Store Address', value: data.storeAddress },
  { title: 'Upload Date', value: data.uploadDate },
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
      <div class="flex justify-evenly">
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
            <!-- TODO: Handle possible duplicate's invoice image -->
            <img
              key="target-invoice"
              :src="modal.record.picture.medium"
              hidden
            />
          </v-viewer>
        </div>
      </div>
      <div class="mt-8 flex justify-evenly">
        <div class="w-[560px]">
          <TableInformation
            title="Original Invoice"
            :data-source="dataSource(invoice)"
          />
        </div>
        <!-- TODO: Handle possible duplicate's invoice source of information -->
        <div class="w-[560px]">
          <TableInformation
            title="Target Invoice"
            :data-source="dataSource(invoice)"
          />
        </div>
      </div>
    </div>
  </Modal>
</template>
