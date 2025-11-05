export interface Product {
  id: number | string;
  name: string | undefined;
  description?: string;
  price?: number;
  unique_code: string | undefined;
}
