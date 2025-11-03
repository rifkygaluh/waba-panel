import axios from 'axios';
import dayjs from 'dayjs';

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

const queryData = async (params: APIParams) => {
  const res = await axios.get<APIResult>('/api/invoice/history', {
    params,
  });
  return res.data;
};

const columns = [
  {
    title: 'Invoice Number',
    dataIndex: 'invoice_number',
    sorter: true,
  },
  {
    title: 'Amount',
    dataIndex: 'amount',
    sorter: true,
    customRender: ({ text }: { text: number }) =>
      text.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
      }),
  },
  {
    title: 'User',
    dataIndex: 'user',
  },
  {
    title: 'Store',
    dataIndex: 'store',
  },
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
