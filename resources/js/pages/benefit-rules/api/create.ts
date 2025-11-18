import { NotificationResponse, notifyError, notifySuccess } from '@/lib/api';
import benefitRules from '@/routes/benefit-rules';
import { Rule } from '@/types/rule';
import { router } from '@inertiajs/vue3';
import axios, { AxiosError, AxiosResponse } from 'axios';

export async function store(rule: Rule): Promise<void> {
  axios
    .post('/benefit-rules', {
      name: rule.name,
      type: rule.type,
      start_date: Array.isArray(rule.period) ? rule.period[0] : rule.period,
      end_date: Array.isArray(rule.period) ? rule.period[1] : rule.period,
      items: rule.items.map((item) => ({
        product_id: item.product_id,
        min_value: item.min_value,
        benefit: item.benefit,
        is_rollover: item.is_rollover,
      })),
    })
    .then((res: AxiosResponse<NotificationResponse>) => {
      notifySuccess(res);
      router.visit(benefitRules.index().url);
    })
    .catch((err: AxiosError<NotificationResponse>) => {
      notifyError(err);
    });
}
