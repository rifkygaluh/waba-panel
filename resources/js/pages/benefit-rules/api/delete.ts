import { NotificationResponse, notifyError, notifySuccess } from '@/lib/api';
import benefitRules from '@/routes/benefit-rules';
import { router } from '@inertiajs/vue3';
import axios, { AxiosError, AxiosResponse } from 'axios';

export async function destroy(id: string | number): Promise<void> {
  axios
    .delete(`/benefit-rules/${id}`)
    .then((res: AxiosResponse<NotificationResponse>) => {
      notifySuccess(res);
      router.visit(benefitRules.index().url);
    })
    .catch((err: AxiosError<NotificationResponse>) => {
      notifyError(err);
    });
}
