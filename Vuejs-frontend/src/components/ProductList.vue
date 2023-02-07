<template>
  <div class="btns" style="margin: 30px;">
    <button style="background-color: red !important;" @click="deleteChecked">MASS DELETE</button>
    <router-link :to="{ path: '/product/add' }">
      <button class="">ADD</button>
    </router-link>
  </div>
  <div style="display: inline-block; margin: 20px;" v-for="product in products" :key="product.id">
    <div class="product-card">
      <input type="checkbox" class="delete-checkbox" v-model="product.isChecked" />
      <div>
        <p hidden>{{ product.id }}</p>
        <p>{{ product.name }}</p>
        <p>{{ product.sku }}</p>
        <p>${{ product.price }}</p>
        <div class="attributes" v-for="(value, key) in product.attributes" :key="key">
          <p v-if="product.type == 'book'">Weight : {{ value }} Kg</p>
          <p v-else-if="product.type == 'dvd'">Size : {{ value }} MB</p>
        </div>
        <div style="display: flex;">
          <div class="attributes" v-for="(value, key, index) in product.attributes" :key="key">
            <p style="" v-if="product.type == 'furniture'">
              <span v-if="index == 0">Dimensions : </span>
                {{ value }}
              <span :class="{ hidden: index == 2 }">x</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState(['products'])
  },
  methods: {
    deleteChecked() {
      const selectedIds = this.products.filter(product => product.isChecked).map(product => product.id);
      this.$store.dispatch('deleteProducts', selectedIds);
    }
  },
  created() {
    this.$store.dispatch('fetchProducts');
  }
}
</script> 
<style scoped>
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 30px;
  cursor: pointer;
  border-radius: 7px;
}

.product-card {
  height: 250px;
  width: 350px;
  border: 1px solid #ddd;
  cursor: pointer;
  transition: 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
}

.product-card p {
  text-align-last: center;
  font-size: larger;
}

.product-card .delete-checkbox {
  position: absolute;
  left: 5px;
  top: 5px;
}

.hidden {
  display: none;
}
</style>