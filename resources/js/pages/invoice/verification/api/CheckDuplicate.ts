import axios from 'axios';

type APIParams = {
  results: number;
  page?: number;
  sortField?: string;
  sortOrder?: number;
  [key: string]: any;
};

type APIResult = {
  results: {
    gender: 'female' | 'male';
    name: {
      title: string;
      first: string;
      last: string;
    };
    email: string;
  }[];
};

const queryData = async (params: APIParams) => {
  const res = await axios.get<APIResult>('https://randomuser.me/api?noinfo', {
    params,
  });
  return res.data.results;
};

const columns = [
  {
    title: 'Name',
    dataIndex: 'name',
    sorter: true,
    width: '20%',
    customRender: ({ record: { name } }: { record: any }) =>
      `${name.title} ${name.first} ${name.last}`,
  },
  {
    title: 'Gender',
    dataIndex: 'gender',
    filters: [
      { text: 'Male', value: 'male' },
      { text: 'Female', value: 'female' },
    ],
    customRender: ({ text }: { text: string }) =>
      text.charAt(0).toUpperCase() + text.slice(1),
  },
  {
    title: 'Email',
    dataIndex: 'email',
  },
  {
    title: 'Phone',
    dataIndex: 'cell',
  },
  {
    title: 'Address',
    dataIndex: 'location',
    customRender: ({ record: { location } }: { record: any }) =>
      `${location.street.name} ${location.street.number}, ${location.city} ${location.state}`,
  },
  {
    title: '',
    dataIndex: 'action',
    width: '1%',
  },
];

export { columns, queryData };
