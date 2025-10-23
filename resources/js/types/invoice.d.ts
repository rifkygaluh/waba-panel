export interface InvoiceItem {
  productId: number | string;
  quantity: number;
  price: number;
  discount?: number;
  discountType?: 'percentage' | 'fixed';
  totalPrice: number;
}

export interface Invoice {
  id: number;
  totalPieces: number;
  totalPrice: number;
  uploadDate: string;
  date: string;
  name?: string;
  items: InvoiceItem[];
}
