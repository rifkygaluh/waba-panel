import axios from 'axios';

export type OptionsAPI = {
  value: number;
  label: number;
}[];

export default async function productOptions() {
  const result = axios.get<OptionsAPI>('/api/product/options');

  return (await result).data;
}
