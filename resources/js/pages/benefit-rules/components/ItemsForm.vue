<script setup lang="ts">
import { filterOption } from '@/lib/utils';
import productOptions from '@/pages/product/api/Options';
import { useRuleStore } from '@/stores/rule';
import { Rule } from '@/types/rule';
import {
  Button,
  Form,
  FormItem,
  InputNumber,
  Select,
  Switch,
} from 'ant-design-vue';
import { Plus, Trash } from 'lucide-vue-next';
import { ref } from 'vue';

type Props = {
  submit: (rule: Rule) => Promise<void>;
};

defineProps<Props>();

const rule = useRuleStore();
const products = ref(await productOptions());
</script>

<template>
  <Form layout="vertical">
    <div v-for="(item, index) in rule.items" :key="index">
      <div class="flex gap-4">
        <FormItem class="grow" :label="index === 0 ? 'Product' : null">
          <Select
            class="w-80"
            v-model:value="item.product_id"
            placeholder="Select a product"
            :options="products"
            :filter-option="filterOption"
            show-search
            allow-clear
          />
        </FormItem>
        <FormItem :label="index === 0 ? 'Minimum' : null">
          <InputNumber
            class="min-w-40!"
            v-model:value="item.min_value"
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
            v-model:value="item.benefit"
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
          <Switch v-model:checked="item.is_rollover" />
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
      <Button
        type="primary"
        :disabled="rule.disabledProcessing"
        @click="() => submit(rule)"
      >
        Save
      </Button>
    </div>
  </Form>
</template>

<style scoped>
.ant-form-item {
  margin-bottom: 16px;
}
</style>
