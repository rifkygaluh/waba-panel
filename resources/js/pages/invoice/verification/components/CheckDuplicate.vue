<script setup lang="ts">
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { useInvoiceStore } from '@/stores/invoice';
import { Button, InputSearch } from 'ant-design-vue';

const invoice = useInvoiceStore();
</script>

<template>
  <div id="check-duplicate" class="flex justify-between">
    <h2 class="text-xl">Check for Possible Duplicate</h2>
    <div>
      <InputSearch
        class="flex items-center"
        placeholder="Search for EU Names"
      />
    </div>
  </div>
  <div class="relative h-96">
    <PlaceholderPattern class="w-full" />
  </div>
  <div class="flex justify-end">
    <Button type="primary">Accept Invoice</Button>
  </div>
</template>
