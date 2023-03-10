import { createRouter, createWebHistory } from "vue-router";
import ProductList from "../components/ProductList.vue";
import ProductAdd from "../components/ProductAdd.vue";

const routes = [
  {
    path: "/about",
    name: "About",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/About.vue"),
  },
  { path: "/", name: "ProductList", component: ProductList },
  { path: "/product/add", name: "ProductAdd", component: ProductAdd },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
