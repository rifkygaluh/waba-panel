import { notification } from 'ant-design-vue';
import { AxiosError, AxiosResponse } from 'axios';

export function notifySuccess(res: AxiosResponse<{ message: string }>) {
  notification.success({
    message: 'Verification Success',
    description: res.data?.message,
  });
}

export function notifyError(err: AxiosError<{ message: string }>) {
  if (err.status && err.status >= 400 && err.status <= 422) {
    notification.error({
      message: 'Verification Failed',
      description: err.response?.data?.message,
    });
  } else {
    console.log(err); // TODO: Testing only, remove on production
  }
}
