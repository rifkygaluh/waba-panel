import { numberFormatter } from '@/lib/utils';
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
  const res = await axios.get<APIResult>('/api/benefit-rules', {
    params,
  });
  return res.data;
};

const columns = [
  {
    title: 'Name',
    dataIndex: 'name',
  },
  {
    title: 'Type',
    dataIndex: 'type',
    customRender: ({ text }: { text: string }) =>
      `${text.charAt(0).toUpperCase() + text.slice(1)} Based`,
  },
  {
    title: 'Start Date',
    dataIndex: 'start_date',
    sorter: true,
  },
  {
    title: 'End Date',
    dataIndex: 'end_date',
    sorter: true,
  },
  {
    title: 'Total Items',
    dataIndex: 'total_products',
    sorter: true,
    customRender: ({ text }: { text: number | string }) =>
      numberFormatter(text),
  },
  {
    title: 'Total Benefit',
    dataIndex: 'total_benefits',
    sorter: true,
    customRender: ({ text }: { text: number | string }) =>
      numberFormatter(text),
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
