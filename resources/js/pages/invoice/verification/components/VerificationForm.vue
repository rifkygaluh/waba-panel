<script setup lang="ts">
import { filterOption } from '@/lib/utils';
import { useInvoiceStore } from '@/stores/invoice';
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
import axios from 'axios';
import dayjs from 'dayjs';
import { Plus, Trash } from 'lucide-vue-next';
import { ref } from 'vue';

type APIResult = {
  value: number;
  label: number;
}[];

const invoice = useInvoiceStore();

const products = ref<APIResult>();

axios
  .get<APIResult>('/api/product/options')
  .then((res) => {
    products.value = res.data;
  });
</script>

<template>
  <h2 class="text-xl">Invoice Items</h2>
  <Form layout="vertical">
    <div v-for="(item, index) in invoice.items" :key="index">
      <div class="flex gap-3">
        <FormItem class="grow" :label="index === 0 ? 'Product' : null">
          <Select
            class="w-80"
            v-model:value="item.productId"
            placeholder="Select a product"
            :options="products"
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
              (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
            "
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
            onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
            @change="invoice.setItemTotal(index)"
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
              (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
            "
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
            onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
            @change="invoice.setItemTotal(index)"
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
              @change="invoice.setDiscountType(index)"
            />
            <InputNumber
              class="rounded-l-none"
              v-model:value="item.discount"
              pattern="[0-9]"
              placeholder="0"
              :min="0"
              :max="item.discountType === 'percentage' ? 100 : undefined"
              :formatter="
                (value) =>
                  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
              "
              :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
              onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
              @change="invoice.setItemTotal(index)"
            />
          </InputGroup>
        </FormItem>
        <FormItem :label="index === 0 ? 'Total Price' : null">
          <InputNumber
            class="2xl:w-80"
            addon-before="Rp"
            v-model:value="item.totalPrice"
            pattern="[0-9]"
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
    <div class="flex gap-3">
      <FormItem label="Total Pieces">
        <InputNumber
          v-model:value="invoice.totalPieces"
          pattern="[0-9]"
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
          v-model:value="invoice.totalPrice"
          pattern="[0-9]"
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
      <FormItem label="EU Name">
        <Input
          v-model:value="invoice.name"
          @change="invoice.resetCheckDuplicate"
        />
      </FormItem>
      <FormItem label=" " class="flex grow justify-end">
        <div class="flex gap-3">
          <Button type="primary" :disabled="invoice.disabledVerifying" danger>
            Reject Invoice
          </Button>
          <a href="#check-duplicate">
            <Button
              type="primary"
              @click="invoice.openCheckDuplicate"
              :disabled="invoice.disabledVerifying"
            >
              Check Duplicate
            </Button>
          </a>
        </div>
      </FormItem>
    </div>
  </Form>
</template>

<style scoped>
.ant-form-item {
  margin-bottom: 12px;
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
