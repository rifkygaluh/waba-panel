export interface InvoiceItem {
  product_id: number | string | undefined;
  product_name: number | string | undefined;
  quantity: number | undefined;
  discount: number | undefined;
  discount_type: 'percentage' | 'fixed';
  price: number | undefined;
  total_price: number;
}

export interface Invoice {
  id: string;
  invoice_number: string;
  store: any;
  user: any;
  status: 'pending' | 'accepted' | 'rejected';
  created_at: string;
  total_pieces: number;
  total_price: number;
  image: string;
  date: string;
  name?: string;
  comments?: string;
  items: InvoiceItem[];
}
