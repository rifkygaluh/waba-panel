export interface Product {
  id: number | string;
  name: string | undefined;
  description?: string;
  price?: number;
  uniqueCode: string | undefined;
}
