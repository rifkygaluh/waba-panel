import { Product } from '@/types/product';
import { defineStore } from 'pinia';

export const useProductStore = defineStore('product', {
  state: () =>
    ({
      id: 0,
      name: undefined,
      description: undefined,
      price: undefined,
      unique_code: undefined,
    }) as Product,
  actions: {
    setProduct(data: Product) {
      this.id = data.id;
      this.name = data.name;
      this.description = data.description;
      this.price = data.price;
      this.unique_code = data.unique_code;
    },
  },
});
