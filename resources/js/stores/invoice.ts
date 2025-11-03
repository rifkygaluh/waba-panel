import { Invoice, InvoiceItem } from '@/types/invoice';
import { defineStore } from 'pinia';

const itemTemplate: InvoiceItem = {
  productId: undefined,
  quantity: undefined,
  discountType: 'percentage',
  discount: undefined,
  price: undefined,
  totalPrice: 0,
};

export const useInvoiceStore = defineStore('invoice', {
  state: () => ({
    id: undefined as number | undefined,
    invoice_number: undefined as string | undefined,
    store: undefined as any | undefined,
    user: undefined as any | undefined,
    image: undefined as string | undefined,
    totalPieces: 0,
    totalPrice: 0,
    created_at: '',
    date: '',
    name: '',
    items: [{ ...itemTemplate }],
    checkDuplicate: {
      open: false,
      loading: false,
      search: undefined,
    },
  }),
  getters: {
    pieces: (state) =>
      state.items.reduce(
        (sum, item) => (item.quantity ? sum + item.quantity : sum),
        0,
      ),
    total: (state) =>
      state.items.reduce((sum, item) => sum + item.totalPrice, 0),
    disabledRemoveItem: (state) => state.items.length === 1,
    disabledVerifying: (state) => {
      if (state.totalPrice <= 0) return true;
      if (state.date === '' || !state.date) return true;
      if (state.name.trim() === '' || state.name.trim() === '-') return true;
      if (state.items.find((i) => !i.productId || !i.totalPrice)) return true;
    },
  },
  actions: {
    setInvoice(data: Invoice) {
      this.id = data.id;
      this.invoice_number = data.invoice_number;
      this.store = data.store;
      this.user = data.user;
      this.image = data.image;
      this.totalPieces = data.totalPieces || this.totalPieces;
      this.totalPrice = data.totalPrice || this.totalPrice;
      this.created_at = data.created_at || this.created_at;
      this.date = data.date || this.date;
      this.name = data.name || this.name;
      this.items = data.items?.length > 0 ? data.items : this.items;
    },
    addNewItem() {
      this.items.push({ ...itemTemplate });
      this.resetCheckDuplicate();
    },
    removeItem(index: number) {
      this.items.splice(index, 1);
      this.resetCheckDuplicate();
    },
    openCheckDuplicate() {
      this.checkDuplicate.open = true;
    },
    resetCheckDuplicate() {
      this.checkDuplicate = {
        open: false,
        loading: false,
        search: undefined,
      };
    },
    calculate() {
      this.totalPrice = this.total;
      this.totalPieces = this.pieces;
    },
    setItemTotal(index: number) {
      if (
        this.items[index].price !== undefined &&
        this.items[index].quantity !== undefined
      ) {
        this.resetCheckDuplicate();
        const totalPrice = this.items[index].price * this.items[index].quantity;
        const discount =
          this.items[index].discountType === 'percentage'
            ? totalPrice * ((this.items[index].discount || 0) / 100)
            : this.items[index].discount;
        this.items[index].totalPrice = totalPrice - (discount || 0);
        this.calculate();
      }
    },
    setDiscountType(index: number) {
      this.items[index].discount = undefined;
      this.setItemTotal(index);
    },
  },
});
