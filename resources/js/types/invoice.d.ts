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
  storeName: string;
  storeOwner: string;
  storePhone: string;
  storeAddress: string;
  totalPieces: number;
  totalPrice: number;
  image: string;
  uploadDate: string;
  date: string;
  name?: string;
  items: InvoiceItem[];
}
