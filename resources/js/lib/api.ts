import { notification } from 'ant-design-vue';
import { AxiosError, AxiosResponse } from 'axios';

export type NotificationResponse = {
  message: string;
  description: string;
};

export function notifySuccess(res: AxiosResponse<NotificationResponse>) {
  notification.success({
    message: res.data?.message,
    description: res.data?.description,
  });
}

export function notifyError(err: AxiosError<NotificationResponse>) {
  if (err.status && err.status >= 400 && err.status <= 422) {
    notification.error({
      message: err.response?.data?.message,
      description: err.response?.data?.description,
    });
  } else {
    console.log(err); // TODO: Testing only, remove on production
  }
}

export async function fetchImage(url: string | undefined) {
  if (url) {
    const response = await fetch(url, {
      headers: {
        'X-Api-Key': import.meta.env.VITE_API_KEY,
        'X-Api-Secret': import.meta.env.VITE_API_SECRET,
      },
    });
    const blob = await response.blob();
    return URL.createObjectURL(blob);
  }
  return undefined;
}
