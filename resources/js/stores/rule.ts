import { Rule, RuleItem } from '@/types/rule';
import { defineStore } from 'pinia';

const itemTemplate: RuleItem = {
  productId: undefined as string | number | undefined,
  minimumValue: undefined as number | undefined,
  benefitPoint: undefined as number | undefined,
  balanceRollover: false,
};

export const useRuleStore = defineStore('rule', {
  state: () =>
    ({
      name: undefined,
      type: undefined,
      dateRange: undefined,
      items: [{ ...itemTemplate }],
    }) as Rule,
  getters: {
    disabledRemoveItem: (state) => state.items.length === 1,
    disabledProcessing: (state) => {
      if (!state.dateRange) return true;
      if (!state.name || state.name.trim() === '') return true;
      if (
        state.items.find(
          (i) =>
            !i.productId || i.minimumValue === undefined || !i.benefitPoint,
        )
      ) {
        return true;
      }
    },
  },
  actions: {
    addNewItem() {
      this.items.push({ ...itemTemplate });
    },
    removeItem(index: number) {
      this.items.splice(index, 1);
    },
  },
});
