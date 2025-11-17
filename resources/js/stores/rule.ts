import { Rule, RuleItem } from '@/types/rule';
import { defineStore } from 'pinia';

const itemTemplate: RuleItem = {
  id: undefined,
  product_id: undefined,
  min_value: undefined,
  benefit: undefined,
  is_rollover: false,
};

export const useRuleStore = defineStore('rule', {
  state: () =>
    ({
      name: undefined,
      type: undefined,
      period: undefined,
      items: [{ ...itemTemplate }],
    }) as Rule,
  getters: {
    disabledRemoveItem: (state) => state.items.length === 1,
    disabledProcessing: (state) => {
      if (!state.period) return true;
      if (!state.name || state.name.trim() === '') return true;
      if (
        state.items.find(
          (i) => !i.product_id || i.min_value === undefined || !i.benefit,
        )
      ) {
        return true;
      }
    },
  },
  actions: {
    setRule(data: Rule) {
      this.$reset();
      this.id = data.id;
      this.name = data.name;
      this.type = data.type;
      this.period = data.period;
      this.items = data.items.length > 0 ? data.items : this.items;
    },
    addNewItem() {
      this.items.push({ ...itemTemplate });
    },
    removeItem(index: number) {
      this.items.splice(index, 1);
    },
  },
});
