import { Invoice, InvoiceItem } from '@/types/invoice';
import { defineStore } from 'pinia';

const itemTemplate: InvoiceItem = {
  product_id: undefined,
  product_name: undefined,
  quantity: undefined,
  discount_type: 'percentage',
  discount: undefined,
  price: undefined,
  total_price: 0,
};

export const useInvoiceStore = defineStore('invoice', {
  state: () => ({
    id: '',
    invoice_number: undefined as string | undefined,
    store: undefined as any | undefined,
    user: undefined as any | undefined,
    image: undefined as string | undefined,
    total_pieces: 0,
    total_price: 0,
    created_at: '',
    date: '',
    name: '',
    comments: '',
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
      state.items.reduce((sum, item) => sum + item.total_price, 0),
    disabledRemoveItem: (state) => state.items.length === 1,
    disabledAccepting: (state) => {
      if (state.total_price <= 0) return true;
      if (state.date === '' || !state.date) return true;
      // if (state.name.trim() === '' || state.name.trim() === '-') return true;
      if (state.items.find((i) => !i.product_id || !i.total_price)) return true;
    },
    disabledRejecting: (state) => {
      if (
        state.items.find((i) => {
          if (i.product_id) return !i.total_price;
          return false;
        })
      )
        return true;
    },
  },
  actions: {
    setInvoice(data: Invoice) {
      this.$reset();
      this.id = data.id;
      this.invoice_number = data.invoice_number;
      this.store = data.store;
      this.user = data.user;
      this.image = data.image;
      this.total_pieces = data.total_pieces || this.total_pieces;
      this.total_price = data.total_price || this.total_price;
      this.created_at = data.created_at || this.created_at;
      this.date = data.date || this.date;
      this.name = data.name || this.name;
      this.comments = data.comments || this.comments;
      this.items = data.items?.length > 0 ? data.items : this.items;
      if (this.items.length > 0) {
        this.items.forEach((_, index) => {
          this.setItemTotal(index);
        });
        this.calculate();
      }
    },
    addNewItem() {
      this.items.push({ ...itemTemplate });
      this.resetCheckDuplicate();
    },
    removeItem(index: number) {
      this.items.splice(index, 1);
      this.resetCheckDuplicate();
    },
    clearItem(index: number) {
      this.items[index] = { ...itemTemplate };
      this.calculate();
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
      this.total_price = this.total;
      this.total_pieces = this.pieces;
    },
    setItemTotal(index: number) {
      if (
        this.items[index].price !== undefined &&
        this.items[index].quantity !== undefined
      ) {
        this.resetCheckDuplicate();
        const total_price =
          this.items[index].price * this.items[index].quantity;
        const discount =
          this.items[index].discount_type === 'percentage'
            ? total_price * ((this.items[index].discount || 0) / 100)
            : this.items[index].discount;
        this.items[index].total_price = total_price - (discount || 0);
        this.calculate();
      }
    },
    setDiscountType(index: number) {
      this.items[index].discount = undefined;
      this.setItemTotal(index);
    },
  },
});
