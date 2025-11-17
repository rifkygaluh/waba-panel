<script setup lang="ts">
import { filterOption } from '@/lib/utils';
import productOptions from '@/pages/product/api/options';
import { useInvoiceStore } from '@/stores/invoice';
import { InvoiceItem } from '@/types/invoice';
import {
  AutoComplete,
  Button,
  DatePicker,
  Form,
  FormItem,
  InputGroup,
  InputNumber,
  Modal,
  Select,
} from 'ant-design-vue';
import dayjs from 'dayjs';
import { Plus, Trash } from 'lucide-vue-next';
import { reactive, ref } from 'vue';
import { reject } from '../api/form-submission';

const invoice = useInvoiceStore();

const products = ref(await productOptions());

const onChangeProduct = (item: InvoiceItem, index: number) => {
  if (item.product_id) {
    item.product_name = products.value?.find(
      (p) => p.value === item.product_id,
    )?.label;
  } else {
    invoice.clearItem(index);
  }
};

const handleSubmit = () => {
  invoice.openCheckDuplicate();
  setTimeout(() => window.scrollTo(0, document.body.scrollHeight), 1);
};

const rejectModal = reactive({
  open: false,
  loading: false,
  setOpen: () => {
    rejectModal.open = !rejectModal.open;
  },
  submit: async () => {
    rejectModal.loading = true;
    await reject(invoice);
    rejectModal.loading = false;
    rejectModal.open = false;
  },
});
</script>

<template>
  <h2 class="text-xl">Invoice Items</h2>
  <Form layout="vertical" class="space-y-5">
    <div v-for="(item, index) in invoice.items" :key="index">
      <div class="flex gap-5">
        <div class="grid grid-cols-12 gap-5">
          <FormItem class="col-span-4" :label="index === 0 ? 'Product' : null">
            <Select
              class="w-full!"
              v-model:value="item.product_id"
              placeholder="Select a product"
              :options="products"
              :filter-option="filterOption"
              @change="onChangeProduct(item, index)"
              show-search
              allow-clear
            />
          </FormItem>
          <FormItem class="col-span-1" :label="index === 0 ? 'Quantity' : null">
            <InputNumber
              class="w-full!"
              v-model:value="item.quantity"
              placeholder="0"
              :min="0"
              :formatter="
                (value) =>
                  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
              "
              :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
              onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
              @change="invoice.setItemTotal(index)"
              :disabled="!item.product_id"
            />
          </FormItem>
          <FormItem class="col-span-2" :label="index === 0 ? 'Price' : null">
            <InputNumber
              class="w-full!"
              addon-before="Rp"
              v-model:value="item.price"
              placeholder="0"
              :min="0"
              :formatter="
                (value) =>
                  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
              "
              :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
              onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
              @change="invoice.setItemTotal(index)"
              :disabled="!item.product_id"
            />
          </FormItem>
          <FormItem class="col-span-2" :label="index === 0 ? 'Discount' : null">
            <InputGroup class="flex!">
              <Select
                class="w-16 rounded-r-none"
                v-model:value="item.discount_type"
                :options="[
                  { label: '%', value: 'percentage' },
                  { label: 'Rp', value: 'fixed' },
                ]"
                @change="invoice.setDiscountType(index)"
                :disabled="!item.product_id"
              />
              <InputNumber
                class="w-full! rounded-l-none"
                v-model:value="item.discount"
                placeholder="0"
                :min="0"
                :max="item.discount_type === 'percentage' ? 100 : undefined"
                :formatter="
                  (value) =>
                    value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                "
                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
                @change="invoice.setItemTotal(index)"
                :disabled="!item.product_id"
              />
            </InputGroup>
          </FormItem>
          <FormItem
            class="col-span-3"
            :label="index === 0 ? 'Total Price' : null"
          >
            <InputNumber
              class="w-full!"
              addon-before="Rp"
              v-model:value="item.total_price"
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
        </div>
        <FormItem :label="index === 0 ? ' ' : null">
          <Button
            class="px-2.5!"
            type="primary"
            @click="invoice.removeItem(index)"
            :disabled="invoice.disabledRemoveItem"
            danger
          >
            <Trash
              class="h-4 w-4"
              :fill="invoice.disabledRemoveItem ? 'lightgray' : 'white'"
            />
          </Button>
        </FormItem>
      </div>
    </div>
    <div class="flex justify-end">
      <FormItem>
        <Button class="px-2.5!" @click="invoice.addNewItem">
          <Plus class="h-4 w-4" />
        </Button>
      </FormItem>
    </div>
    <div class="flex gap-5">
      <FormItem label="Total Pieces">
        <InputNumber
          v-model:value="invoice.total_pieces"
          placeholder="0"
          :min="0"
          :formatter="
            (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
          "
          :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
          onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
          disabled
        />
      </FormItem>
      <FormItem label="Total Price">
        <InputNumber
          addon-before="Rp"
          v-model:value="invoice.total_price"
          placeholder="0"
          :min="0"
          :formatter="
            (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
          "
          :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
          onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
          disabled
        />
      </FormItem>
      <FormItem label="Upload Date">
        <DatePicker
          valueFormat="YYYY-MM-DD"
          v-model:value="invoice.created_at"
          disabled
        />
      </FormItem>
      <FormItem label="Invoice Date">
        <DatePicker
          valueFormat="YYYY-MM-DD"
          v-model:value="invoice.date"
          :defaultPickerValue="dayjs(invoice.created_at).format('YYYY-MM-DD')"
          @change="invoice.resetCheckDuplicate"
        />
      </FormItem>
      <!-- <FormItem label="EU Name">
        <Input
          v-model:value="invoice.name"
          @change="invoice.resetCheckDuplicate"
        />
      </FormItem> -->
      <FormItem label=" " class="flex grow justify-end">
        <div class="flex gap-5">
          <Button
            type="primary"
            @click="rejectModal.setOpen"
            :disabled="invoice.disabledRejecting"
            danger
          >
            Reject Invoice
          </Button>
          <Button
            type="primary"
            html-type="submit"
            @click="handleSubmit"
            :disabled="invoice.disabledAccepting"
          >
            Check Duplicate
          </Button>
        </div>
      </FormItem>
    </div>
    <Modal v-model:open="rejectModal.open" :closable="false">
      <Form layout="vertical">
        <FormItem label="Comments">
          <AutoComplete v-model:value="invoice.comments" />
        </FormItem>
      </Form>
      <template #footer>
        <div class="flex w-full gap-5">
          <div class="flex items-center">
            Are you sure to reject this invoice?
          </div>
          <div class="flex grow justify-end space-x-2">
            <Button
              @click="rejectModal.setOpen"
              :disabled="rejectModal.loading"
            >
              Cancel
            </Button>
            <Button
              type="primary"
              @click="rejectModal.submit"
              :loading="rejectModal.loading"
              :disabled="rejectModal.loading"
              danger
            >
              Confirm
            </Button>
          </div>
        </div>
      </template>
    </Modal>
  </Form>
</template>

<style scoped>
.ant-form-item {
  margin-bottom: 0px;
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
</style>
