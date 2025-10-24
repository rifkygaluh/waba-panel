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
    totalPieces: 0,
    totalPrice: 0,
    uploadDate: '',
    date: '',
    name: '',
    items: [{ ...itemTemplate }],
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
    disabledCheckDuplicates: (state) => {
      if (state.totalPrice <= 0) return true;
      if (state.date === '' || !state.date) return true;
      if (state.name.trim() === '' || state.name.trim() === '-') return true;
      if (state.items.find((i) => !i.productId)) return true;
    },
  },
  actions: {
    setInvoice(data: Invoice) {
      this.totalPieces = data.totalPieces || this.totalPieces;
      this.totalPrice = data.totalPrice || this.totalPrice;
      this.uploadDate = data.uploadDate || this.uploadDate;
      this.date = data.date || this.date;
      this.name = data.name || this.name;
      this.items = data.items.length > 0 ? data.items : this.items;
    },
    addNewItem() {
      this.items.push({ ...itemTemplate });
    },
    removeItem(index: number) {
      this.items.splice(index, 1);
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
