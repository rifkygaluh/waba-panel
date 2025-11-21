import { NotificationResponse, notifyError, notifySuccess } from '@/lib/api';
import product from '@/routes/product';
import { router } from '@inertiajs/vue3';
import axios, { AxiosError, AxiosResponse } from 'axios';

export async function destroy(id: string | number): Promise<void> {
  axios
    .delete(`/product/${id}`)
    .then((res: AxiosResponse<NotificationResponse>) => {
      notifySuccess(res);
      router.visit(product.index().url);
    })
    .catch((err: AxiosError<NotificationResponse>) => {
      notifyError(err);
    });
}
