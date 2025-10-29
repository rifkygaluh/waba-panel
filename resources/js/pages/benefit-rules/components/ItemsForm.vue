<script setup lang="ts">
import { filterOption } from '@/lib/utils';
import { useRuleStore } from '@/stores/rule';
import {
  Button,
  Form,
  FormItem,
  InputNumber,
  Select,
  Switch,
} from 'ant-design-vue';
import { Plus, Trash } from 'lucide-vue-next';

const rule = useRuleStore();
</script>

<template>
  <Form layout="vertical">
    <div v-for="(item, index) in rule.items" :key="index">
      <div class="flex gap-4">
        <FormItem class="grow" :label="index === 0 ? 'Product' : null">
          <Select
            class="w-80"
            v-model:value="item.productId"
            placeholder="Select a product"
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
        <FormItem :label="index === 0 ? 'Minimum' : null">
          <InputNumber
            class="min-w-40!"
            v-model:value="item.minimumValue"
            :addon-before="rule.type === 'price' ? 'Rp' : undefined"
            pattern="[0-9]"
            placeholder="0"
            :min="0"
            :formatter="
              (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
            "
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
            onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
          />
        </FormItem>
        <FormItem :label="index === 0 ? 'Benefit' : null">
          <InputNumber
            class="min-w-40!"
            v-model:value="item.benefitPoint"
            pattern="[0-9]"
            placeholder="0"
            :min="0"
            :formatter="
              (value) => value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
            "
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
            onkeydown="if(event.key==='.' || event.key==='-'){event.preventDefault();}"
          />
        </FormItem>
        <FormItem :label="index === 0 ? 'Rollover' : null" class="w-14">
          <Switch v-model:checked="item.balanceRollover" />
        </FormItem>
        <FormItem :label="index === 0 ? ' ' : null">
          <Button
            class="px-2.5!"
            type="primary"
            @click="rule.removeItem(index)"
            :disabled="rule.disabledRemoveItem"
            danger
          >
            <Trash
              class="h-4 w-4"
              :fill="rule.disabledRemoveItem ? 'lightgray' : 'white'"
            />
          </Button>
        </FormItem>
      </div>
    </div>
    <div class="flex justify-end">
      <FormItem>
        <Button class="px-2.5!" @click="rule.addNewItem">
          <Plus class="h-4 w-4" />
        </Button>
      </FormItem>
    </div>
    <div class="mt-5 flex justify-end">
      <Button type="primary" :disabled="rule.disabledProcessing">Save</Button>
    </div>
  </Form>
</template>

<style scoped>
.ant-form-item {
  margin-bottom: 16px;
}
</style>
