export interface InvoiceItem {
  productId: number | string | undefined;
  quantity: number | undefined;
  discount: number | undefined;
  discountType: 'percentage' | 'fixed';
  price: number | undefined;
  totalPrice: number;
}

export interface Invoice {
  id: number;
  invoice_number: string;
  store: any;
  user: any;
  status: 'pending' | 'accepted' | 'rejected';
  created_at: string;
  totalPieces: number;
  totalPrice: number;
  image: string;
  date: string;
  name?: string;
  items: InvoiceItem[];
}
