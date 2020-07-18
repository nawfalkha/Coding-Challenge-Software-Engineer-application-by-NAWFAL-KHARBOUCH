<template>
  <div>
    <v-container class="grey lighten-5">
      <v-row class="mb-6" no-gutters>
        <v-col cols="12" sm="2">
          <v-card class="pa-2" outlined tile>
            <v-container fluid>
              <p>Category :</p>
              <div>
                <input type="radio" name="" v-model="CheckCategory" value="" />
                <span>All</span>
              </div>
              <div v-for="category in categorys">
                <input
                  type="radio"
                  name=""
                  v-model="CheckCategory"
                  :value="category.id"
                />
                <span>{{ category.name }}</span>
              </div>
            </v-container>
            <v-container fluid>
              <p>Order By :</p>
              <div>
                <input type="radio" name="orderby" v-model="orderby" value="name" />
                <span>Name</span>
              </div>
              <div>
                <input type="radio" name="orderby" v-model="orderby" value="price" />
                <span>Price</span>
              </div>
            </v-container>
          </v-card>
        </v-col>
        <v-col cols="12" sm="10">
          <v-row class="mb-6" no-gutters>
            <v-col cols="12" sm="4" v-for="product in products" :key="product.id">
              <v-card class="mx-auto" max-width="400">
                <v-img
                  class="white--text align-end"
                  height="200px"
                  :src="product.image"
                >
                  <v-card-title style="color:#ffffff">{{ product.name }}</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">{{ product.name }}</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>{{ product.description }}</div>
                </v-card-text>

                <v-card-actions>
                  <v-btn color="orange" text> {{ product.price }} Dhs </v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Product from "../../Apis/Product";
import Category from "../../Apis/Category";

export default {
  data() {
    return {
      products: [],
      categorys: [],
      CheckCategory: null,
      orderby: null
    };
  },
  methods: {
    allProducts: function() {
      this.products = [];
      Product.allproducts()
        .then(response => {
          this.products = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    allCategorys: function() {
      this.categorys = [];
      Category.allcategorys()
        .then(response => {
          this.categorys = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    filter: function() {
      Product.getProductsByCategory(this.CheckCategory, this.orderby)
        .then(response => {
          this.products = response.data.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.allProducts();
    this.allCategorys();
  },
  watch: {
    CheckCategory: function(value) {
      this.filter();
    },
    orderby: function(value) {
      this.filter();
    }
  }
};
</script>
