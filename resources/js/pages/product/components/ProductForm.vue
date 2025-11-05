<script setup lang="ts">
import { numberFormatter, numberParser } from '@/lib/utils';
import { Product } from '@/types/product';
import { Form, FormItem, Input, InputNumber } from 'ant-design-vue';

type Props = {
  product: Product;
};

defineProps<Props>();
</script>

<template>
  <Form layout="vertical">
    <div class="grid grid-cols-2 gap-5">
      <FormItem label="Name">
        <Input v-model:value="product.name" />
      </FormItem>
      <FormItem label="Price">
        <InputNumber
          class="w-full"
          addon-before="Rp"
          v-model:value="product.price"
          :formatter="numberFormatter"
          :parser="numberParser"
        />
      </FormItem>
      <FormItem label="Description">
        <Input.TextArea v-model:value="product.description" :rows="4" />
      </FormItem>
      <FormItem label="Unique Code">
        <Input v-model:value="product.unique_code" />
      </FormItem>
    </div>
  </Form>
</template>

<style>
.ant-form-item {
  margin-bottom: 0px;
}
</style>
