<script setup lang="ts">
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import Card from '@/components/ui/card/Card.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { filterOption } from '@/lib/utils';
import verification from '@/routes/invoice/verification';
import { type BreadcrumbItem } from '@/types';
import { Invoice } from '@/types/invoice';
import { Head } from '@inertiajs/vue3';
import {
  Button,
  DatePicker,
  Form,
  FormItem,
  Input,
  InputGroup,
  InputNumber,
  Select,
} from 'ant-design-vue';
import { Plus, Trash } from 'lucide-vue-next';
import { component as VViewer } from 'v-viewer';

type Props = {
  invoice: Invoice;
};

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Invoice',
  },
  {
    title: 'Verification',
    href: verification.index().url,
  },
  {
    title: props.invoice.id.toString(),
  },
];

if (props.invoice.items.length === 0) {
  props.invoice.items = [
    {
      productId: 'Product A',
      quantity: 2,
      discountType: 'percentage',
      price: 50000,
      totalPrice: 100000,
    },
    {
      productId: 'Product B',
      quantity: 1,
      discountType: 'percentage',
      price: 100000,
      totalPrice: 100000,
    },
    {
      productId: 'Product C',
      quantity: 5,
      discountType: 'percentage',
      price: 20000,
      totalPrice: 100000,
    },
  ];
  props.invoice.totalPieces = props.invoice.items.reduce(
    (sum, item) => sum + item.quantity,
    0,
  );
  props.invoice.totalPrice = props.invoice.items.reduce(
    (sum, item) => sum + item.totalPrice,
    0,
  );
}
</script>

<template>
  <Head title="Invoice Verification" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div
      class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
    >
      <Card class="px-6">
        <!-- <h1 class="text-2xl">Invoice Verification Detail</h1> -->
        <div class="grid grid-cols-2 gap-6">
          <div>
            <v-viewer class="min-h-[440px]" :options="{ inline: true }">
              <img
                key="https://picsum.photos/200"
                src="https://picsum.photos/200"
                hidden
              />
            </v-viewer>
          </div>
          <div class="relative">
            <h2 class="text-xl">Invoice Information</h2>
            <PlaceholderPattern class="mt-10 h-[calc(100%-40px)] w-full" />
          </div>
        </div>
      </Card>
      <Card class="px-6">
        <h2 class="text-xl">Invoice Items</h2>
        <Form layout="vertical">
          <div v-for="(item, index) in invoice.items" :key="index">
            <div class="flex gap-4">
              <FormItem class="grow" :label="index === 0 ? 'Product' : null">
                <Select
                  class="min-w-80"
                  v-model:value="item.productId"
                  :options="[
                    { label: 'Product A', value: 'Product A' },
                    { label: 'Product B', value: 'Product B' },
                    { label: 'Product C', value: 'Product C' },
                    { label: 'Product D', value: 'Product D' },
                    { label: 'Product E', value: 'Product E' },
                  ]"
                  :filter-option="filterOption"
                  show-search
                  allow-clear
                />
              </FormItem>
              <FormItem :label="index === 0 ? 'Quantity' : null">
                <InputNumber
                  v-model:value="item.quantity"
                  pattern="[0-9]"
                  placeholder="0"
                  :min="0"
                  :formatter="
                    (value) =>
                      value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                  "
                  :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                  onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                />
              </FormItem>
              <FormItem :label="index === 0 ? 'Price' : null">
                <InputNumber
                  addon-before="Rp"
                  v-model:value="item.price"
                  pattern="[0-9]"
                  placeholder="0"
                  :min="0"
                  :formatter="
                    (value) =>
                      value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                  "
                  :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                  onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                />
              </FormItem>
              <FormItem :label="index === 0 ? 'Discount' : null">
                <InputGroup class="flex!">
                  <Select
                    class="w-16 rounded-r-none"
                    v-model:value="item.discountType"
                    :options="[
                      { label: '%', value: 'percentage' },
                      { label: 'Rp', value: 'fixed' },
                    ]"
                  />
                  <InputNumber
                    class="rounded-l-none"
                    v-model:value="item.discount"
                    pattern="[0-9]"
                    placeholder="0"
                    :min="0"
                    :formatter="
                      (value) =>
                        value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                    "
                    :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                    onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                  />
                </InputGroup>
              </FormItem>
              <FormItem :label="index === 0 ? 'Total Price' : null">
                <InputNumber
                  class="min-w-[320px]"
                  addon-before="Rp"
                  v-model:value="item.totalPrice"
                  pattern="[0-9]"
                  placeholder="0"
                  :min="0"
                  :formatter="
                    (value) =>
                      value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                  "
                  :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                  onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                  disabled
                />
              </FormItem>
              <FormItem :label="index === 0 ? ' ' : null">
                <Button class="px-2.5!" type="primary" danger>
                  <Trash fill="white" class="h-4 w-4" />
                </Button>
              </FormItem>
            </div>
          </div>
          <div class="flex justify-end">
            <FormItem>
              <Button class="px-2.5!">
                <Plus class="h-4 w-4" />
              </Button>
            </FormItem>
          </div>
          <div class="flex gap-4">
            <FormItem label="Total Pieces">
              <InputNumber
                addon-before="Rp"
                v-model:value="invoice.totalPieces"
                pattern="[0-9]"
                placeholder="0"
                :min="0"
                :formatter="
                  (value) =>
                    value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                "
                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                disabled
              />
            </FormItem>
            <FormItem label="Total Price">
              <InputNumber
                addon-before="Rp"
                v-model:value="invoice.totalPrice"
                pattern="[0-9]"
                placeholder="0"
                :min="0"
                :formatter="
                  (value) =>
                    value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                "
                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                disabled
              />
            </FormItem>
            <FormItem label="Upload Date">
              <DatePicker
                valueFormat="YYYY-MM-DD"
                v-model:value="invoice.uploadDate"
                disabled
              />
            </FormItem>
            <FormItem label="Invoice Date">
              <DatePicker valueFormat="YYYY-MM-DD" v-model:value="invoice.date" />
            </FormItem>
            <FormItem label="EU Name">
              <Input v-model:value="invoice.name" />
            </FormItem>
          </div>
        </Form>
      </Card>
    </div>
  </AppLayout>
</template>

<style scoped>
.ant-form-item {
  margin-bottom: 16px;
}

.rounded-r-none,
.rounded-r-none > * {
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}

.rounded-l-none,
.rounded-l-none > * {
  border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}

/* input[disabled] {
  color: #000 !important;
} */
</style>
