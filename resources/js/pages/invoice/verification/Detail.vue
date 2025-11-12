<script setup lang="ts">
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import verification from '@/routes/invoice/verification';
import { useInvoiceStore } from '@/stores/invoice';
import { type BreadcrumbItem } from '@/types';
import { Invoice } from '@/types/invoice';
import { Head } from '@inertiajs/vue3';
import CheckDuplicate from './components/CheckDuplicate.vue';
import InvoiceInformation from './components/InvoiceInformation.vue';
import VerificationForm from './components/VerificationForm.vue';

type Props = {
  invoice: Invoice;
};

const props = defineProps<Props>();

const invoice = useInvoiceStore();
invoice.setInvoice(props.invoice);

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Invoice',
  },
  {
    title: 'Verification',
    href: verification.index().url,
  },
  {
    title: props.invoice.invoice_number,
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
        <!-- <h1 class="text-2xl">Invoice Verification Detail</h1> -->
        <InvoiceInformation />
      </Card>
      <Card class="px-6">
        <Suspense>
          <VerificationForm />
        </Suspense>
      </Card>
      <Card class="px-6" v-if="invoice.checkDuplicate.open">
        <CheckDuplicate />
      </Card>
    </div>
  </AppLayout>
</template>

<style>
input:disabled,
input[disabled] {
  color: #000 !important;
}
</style>
