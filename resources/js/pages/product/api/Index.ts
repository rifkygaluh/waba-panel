import { currencyFormatter } from '@/lib/utils';
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
  const res = await axios.get<APIResult>('/api/product', {
    params,
  });
  return res.data;
};

const columns = [
  {
    title: 'ID',
    dataIndex: 'id',
    sorter: true,
  },
  {
    title: 'Name',
    dataIndex: 'name',
  },
  {
    title: 'Description',
    dataIndex: 'description',
  },
  {
    title: 'Unique Code',
    dataIndex: 'unique_code',
  },
  {
    title: 'Price',
    dataIndex: 'price',
    sorter: true,
    customRender: ({ text }: { text: number | string }) =>
      currencyFormatter(text),
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
