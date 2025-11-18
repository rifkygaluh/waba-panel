import { currencyFormatter, numberFormatter } from '@/lib/utils';
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
    title: 'User Name',
    dataIndex: 'user_name',
  },
  {
    title: 'Store Code',
    dataIndex: 'store_code',
  },
  {
    title: 'Store Name',
    dataIndex: 'store_name',
  },
  {
    title: 'Total Pieces',
    dataIndex: 'total_pieces',
    sorter: true,
    customRender: ({ text }: { text: number | string }) =>
      numberFormatter(text),
  },
  {
    title: 'Amount',
    dataIndex: 'amount',
    sorter: true,
    customRender: ({ text }: { text: number | string }) =>
      currencyFormatter(text),
  },
  {
    title: 'Status',
    dataIndex: 'status',
  },
  {
    title: 'Comments',
    dataIndex: 'comments',
    customRender: ({ text }: { text: string }) => text || '-',
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
