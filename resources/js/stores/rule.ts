import { Rule, RuleItem } from '@/types/rule';
import dayjs from 'dayjs';
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
    setRule(data: Rule) {
      const dateRange = data.dateRange?.map((d) => dayjs(d));
      this.name = data.name;
      this.type = data.type;
      this.dateRange = dateRange
        ? [dateRange[0], dateRange[1]]
        : this.dateRange;
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
