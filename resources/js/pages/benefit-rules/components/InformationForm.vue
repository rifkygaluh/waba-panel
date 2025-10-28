<script setup lang="ts">
import { useRuleStore } from '@/stores/rule';
import { Form, FormItem, Input, RangePicker, Select } from 'ant-design-vue';

const rule = useRuleStore();
</script>

<template>
  <Form layout="vertical" class="grow">
    <div class="grid grid-cols-4 gap-4">
      <FormItem label="Rule Name" class="mb-0!">
        <div class="max-w-96">
          <Input
            v-model:value="rule.name"
            placeholder="Define the rule or campaign name"
          />
        </div>
      </FormItem>
      <FormItem label="Rule Type" class="mb-0!">
        <div class="max-w-96">
          <Select
            v-model:value="rule.type"
            placeholder="Please select a type"
            allow-clear
          >
            <Select.Option value="quantity"
              >Quantity Based Benefit</Select.Option
            >
            <Select.Option value="price">Price Based Benefit</Select.Option>
          </Select>
        </div>
      </FormItem>
      <FormItem label="Rule Period" class="mb-0!">
        <RangePicker v-model:value="rule.dateRange" />
      </FormItem>
    </div>
  </Form>
</template>
