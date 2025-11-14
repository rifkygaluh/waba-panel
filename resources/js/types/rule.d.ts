import dayjs from 'dayjs';

export interface RuleItem {
  id: number | string | undefined;
  product_id: number | string | undefined;
  min_value: number | undefined;
  benefit: number | undefined;
  is_rollover: boolean | undefined;
}

export interface Rule {
  id: number | string;
  name: string | undefined;
  type: 'quantity' | 'price' | undefined;
  period: [string, string] | [dayjs.Dayjs, dayjs.Dayjs] | undefined;
  items: RuleItem[];
}
