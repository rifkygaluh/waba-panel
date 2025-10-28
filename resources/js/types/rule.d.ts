import dayjs from 'dayjs';

export interface RuleItem {
  productId: number | string | undefined;
  minimumValue: number | undefined;
  benefitPoint: number | undefined;
  balanceRollover: boolean | undefined;
}

export interface Rule {
  name: string | undefined;
  type: 'quantity' | 'price' | undefined;
  dateRange: [string, string] | [dayjs.Dayjs, dayjs.Dayjs] | undefined;
  items: RuleItem[];
}
