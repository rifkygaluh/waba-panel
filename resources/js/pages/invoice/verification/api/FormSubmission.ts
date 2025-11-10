import { notifyError, notifySuccess } from '@/lib/api';
import verification from '@/routes/invoice/verification';
import { InvoiceItem } from '@/types/invoice';
import { router } from '@inertiajs/vue3';
import axios, { AxiosError, AxiosResponse } from 'axios';

type RejectInvoice = {
  id: string;
  items: InvoiceItem[];
  date: string;
  total_pieces: number;
  total_price: number;
  comments: string;
};

export async function reject(invoice: RejectInvoice) {
  axios
    .post(`${invoice.id}/reject`, {
      id: invoice.id,
      items: invoice.items.filter((x) => x.product_id),
      invoice_date: invoice.date,
      total_pieces: invoice.total_pieces,
      amount: invoice.total_price,
      comments: invoice.comments,
    })
    .then((res: AxiosResponse<{ message: string }>) => {
      notifySuccess(res);
      router.visit(verification.index().url);
    })
    .catch((err: AxiosError<{ message: string }>) => {
      notifyError(err);
    });
}

type AcceptInvoice = {
  id: string;
  items: InvoiceItem[];
  date: string;
  total_pieces: number;
  total_price: number;
};

export async function accept(invoice: AcceptInvoice) {
  axios
    .post(`${invoice.id}/accept`, {
      id: invoice.id,
      items: invoice.items,
      invoice_date: invoice.date,
      total_pieces: invoice.total_pieces,
      amount: invoice.total_price,
    })
    .then((res: AxiosResponse<{ message: string }>) => {
      notifySuccess(res);
      router.visit(verification.index().url);
    })
    .catch((err: AxiosError<{ message: string }>) => {
      notifyError(err);
    });
}
