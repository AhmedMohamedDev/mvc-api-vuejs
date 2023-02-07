import { createStore } from "vuex";
import axios from "axios";
export default createStore({
  state: {
    products: [],
    product: {
      sku: "",
      name: "",
      price: 0,
      type: "",
      attributes: {
        size: null,
        weight: null,
        height: null,
        width: null,
        length: null,
      },
    },
  },
  actions: {
    async submitProductData({ commit }, payload) {
      try {
        const response = await axios.post(
          "https://scandi.alusilka.com/api/v1/product",
          payload
        );
        commit("SET_PRODUCTS", response.errors);
      } catch (error) {
        console.log(error);
        throw error;
      }
    },
    async fetchProducts({ commit }) {
      try {
        const response = await axios.get(
          "https://scandi.alusilka.com/api/v1/products"
        );
        commit("SET_PRODUCTS", response.data);
      } catch (error) {
        console.log(error);
        throw error;
      }
    },
    deleteProducts({ commit }, productIds) {
      axios
        .delete("https://scandi.alusilka.com/api/v1/product", {
          data: {
            ids: productIds,
          },
        })
        .then((response) => {
          commit("DELETE_PRODUCTS", productIds);
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mutations: {
    SET_PRODUCTS(state, products) {
      state.products = products;
    },
    DELETE_PRODUCTS(state, productIds) {
      state.products = state.products.filter(
        (product) => !productIds.includes(product.id)
      );
    },
  },
  modules: {},
});
