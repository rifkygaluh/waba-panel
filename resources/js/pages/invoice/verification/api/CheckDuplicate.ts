import { currencyFormatter, numberFormatter } from '@/lib/utils';
import axios from 'axios';
import dayjs from 'dayjs';

type APIPayload = {
  total_pieces: number;
};

type APIParams = {
  results: number;
  page?: number;
  sortField?: string;
  sortOrder?: number;
  [key: string]: any;
};

type APIResult = {
  current_page: number;
  per_page: number;
  total: number;
  data: {
    invoice_number: string;
    amount: number;
    media: string[] | null[];
  }[];
};

const queryData = async (params: APIParams, payload: APIPayload) => {
  const res = await axios.get<APIResult>(
    '/api/invoice/verification/check-duplicate',
    {
      params: {
        ...payload,
        ...params,
        results: 5,
      },
    },
  );
  return res.data;
};

const columns = [
  {
    title: 'Invoice Number',
    dataIndex: 'invoice_number',
    sorter: true,
  },
  {
    title: 'User Name',
    dataIndex: 'user_name',
  },
  {
    title: 'Store Name',
    dataIndex: 'store_name',
  },
  {
    title: 'Total Pieces',
    dataIndex: 'total_pieces',
    customRender: ({ text }: { text: string | number }) =>
      numberFormatter(text),
  },
  {
    title: 'Total Price',
    dataIndex: 'amount',
    customRender: ({ text }: { text: string | number }) =>
      currencyFormatter(text),
  },
  // {
  //   title: 'EU Name',
  //   dataIndex: 'name',
  // },
  {
    title: 'Upload Date',
    dataIndex: 'created_at',
    sorter: true,
    customRender: ({ text }: { text: string }) =>
      dayjs(text).format('DD-MM-YYYY'),
  },
  {
    title: '',
    dataIndex: 'action',
    width: '1%',
  },
];

export { columns, queryData };
