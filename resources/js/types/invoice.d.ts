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
  totalPieces: number;
  totalPrice: number;
  uploadDate: string;
  date: string;
  name?: string;
  items: InvoiceItem[];
}
