<template>
  <div>
    <form style="width:50%;" id="product_form" :model="product" ref="product_form">
      <div style="padding:10px" class="single-input">
        <p for="sku">SKU:</p>
        <input type="text" id="sku" v-model="product.sku" />
      </div>
      <div style="padding: 4px; color:red" v-if="errors.sku">{{ errors.sku[0] }}</div>
      <div style="padding:10px" class="single-input">
        <p for="name">Name:</p>
        <input type="text" id="name" v-model="product.name" />
      </div>
      <div style="padding: 4px; color:red" v-if="errors.name">{{ errors.name[0] }}</div>

      <div style="padding:10px" class="single-input">
        <p for="price">Price:</p>
        <input type="text" id="price" v-model="product.price" />
      </div>
      <div v-if="errors.price" style="color:red">{{ errors.price[0] }}</div>
      <div style="padding:10px" class="single-input">
        <p for="productType">Product Type:</p>
        <select id="productType" style="width:30%" v-model="product.productType">
          <option v-for="(type, index) in types" :value="type.val" :key="index">
            {{ type.name }}
          </option>
        </select>
      </div>
      <div style="padding: 4px; color:red" v-if="errors.productType">{{ errors.productType[0] }}</div>
      <div style="padding:10px" class="single-input" v-if="product.productType === 'book'">
        <p for="weight">Weight:</p>
        <input type="text" style="width:30px" id="weight" v-model="product.weight" />
        <div style="padding: 4px; color:red" v-if="errors.weight">{{ errors.weight[0] }}</div>
      </div>
      <h4 v-if="product.productType === 'book'">Please, provide weight</h4>
      <div style="padding:10px" class="single-input" v-if="product.productType === 'dvd'">
        <p for="size">Size:</p>
        <input type="text" style="width:30px" id="size" v-model="product.size" />
        <div v-if="errors.size" style="color:red;padding: 4px;">{{ errors.size[0] }}</div>
      </div>
      <h4 v-if="product.productType === 'dvd'">Please, provide size</h4>
      <div v-if="product.productType === 'furniture'">
        <div class="single-input">
          <p for="height">Height:</p>
          <input type="text" style="width:30px" id="height" v-model="product.height" />
          <div style="padding: 4px; color:red" v-if="errors.height">{{ errors.height[0] }}</div>
        </div>

        <div class="single-input">
          <p for="width">Width:</p>
          <input type="text" style="width:30px" id="width" v-model="product.width" />
          <div style="padding: 4px; color:red" v-if="errors.width">{{ errors.width[0] }}</div>
        </div>

        <div class="single-input">
          <p for="length">Length:</p>
          <input type="text" style="width:30px" id="length" v-model="product.length" />
          <div style="padding: 4px; color:red" v-if="errors.length">{{ errors.length[0] }}</div>
        </div>
      </div>
      <h4 v-if="product.productType === 'furniture'">Please, provide dimensions</h4>
      <div>
        <button @click.prevent="saveForm('product_form')">Save</button>
        <router-link :to="{ path: '/product/list' }">
          <button>Cancel</button>
        </router-link>

      </div>
    </form>
  </div>
</template>
<script>
//import { mapActions } from "vuex";
export default {
  data() {
    return {
      product: {
        sku: "",
        name: "",
        price: "",
        productType: "",
        weight: null,
        size: null,
        height: null,
        width: null,
        length: null,
      },
      types: [{ name: "Book", val: "book" }, { name: "DVD", val: "dvd" }, { name: "Furniture", val: "furniture" }],
      errors: {
        sku: "",
        name: "",
        price: "",
        productType: "",
        weight: null,
        size: null,
        height: null,
        width: null,
        length: null,
      },
    };
  },
  computed: {},
  methods: {
    async saveForm() {
      try {
        await this.$store.dispatch("submitProductData", this.product);
        this.errors = {};
        this.product = {};
        this.$router.push('/product/list');
      } catch (error) {
        this.errors = error.response.data.errors;
        console.log(this.errors);
      }
    },
  },
};
</script>
<style scoped>
#product_form input:focus,
#product_form select:focus,
#product_form select:active {
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075),
    0 0 4px rgba(108, 162, 237, 0.6);
  outline: none;
}

#product_form p {
  width: 130px !important;
  font-size: 18px;
  margin: 0;
  font-weight: 500;
  text-align: left
}

#product_form .single-input {
  display: flex;
  align-items: center;
}

#product_form input,
#product_form select {
  padding: 12px 10px;
  font-size: 16px;
  color: #333;
  border: 1px solid #bebebe;
  border-radius: 4px;
  width: 100%;
}
</style>