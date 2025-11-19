import { NotificationResponse, notifyError, notifySuccess } from '@/lib/api';
import product from '@/routes/product';
import { Product } from '@/types/product';
import { router } from '@inertiajs/vue3';
import axios, { AxiosError, AxiosResponse } from 'axios';

export async function update(data: Product): Promise<void> {
  axios
    .patch(`/product/${data.id}`, {
      name: data.name,
      price: data.price,
      description: data.description,
      unique_code: data.unique_code,
    })
    .then((res: AxiosResponse<NotificationResponse>) => {
      notifySuccess(res);
      router.visit(product.index().url);
    })
    .catch((err: AxiosError<NotificationResponse>) => {
      notifyError(err);
    });
}
