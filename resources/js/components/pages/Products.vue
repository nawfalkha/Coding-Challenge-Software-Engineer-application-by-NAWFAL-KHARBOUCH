<template>
  <div>
    <v-container class="grey lighten-5">
      <v-row class="mb-6" no-gutters>
        <v-col v-if="loading" cols="12" sm="12" style="text-align: center;">
          <v-progress-circular indeterminate color="#c01818"></v-progress-circular>
        </v-col>
        <v-col v-else cols="12" sm="12">
          <div data-app>
            <NProduct></NProduct>
          </div>

          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">ID</th>
                  <th class="text-left">NAME</th>
                  <th class="text-left">DESCRIPTION</th>
                  <th class="text-left">PRICE</th>
                  <th class="text-left">IMAGE</th>
                  <th class="text-left"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in products" :key="product.name">
                  <td>
                    <v-chip class="ma-2" color="#5cbbf6">
                      {{ product.id }}
                    </v-chip>
                  </td>
                  <td>{{ product.name }}</td>
                  <td>{{ product.description }}</td>
                  <td>{{ product.price }}</td>
                  <td>
                    <img style="width: 150px;" :src="product.image" :alt="product.name" />
                  </td>

                  <td>
                    <v-btn
                      class="ma-2"
                      tile
                      outlined
                      style="color:red;"
                      @click="destroyProduct(product.id)"
                    >
                      <v-icon left>mdi-close-circle</v-icon> DELETE
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Product from "../../Apis/Product";

export default {
  data() {
    return {
      products: [],
      loading: true
    };
  },
  methods: {
    allProducts: function() {
      this.products = [];
      this.loading = true;
      Product.allproducts()
        .then(response => {
          this.products = response.data.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    destroyProduct: function(id) {
      Product.destroy(id)
        .then(response => {
          this.allProducts();
          Toast.fire({
            type: "success",
            title: "Product deleted successfully"
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.allProducts();
  },
  watch: {}
};
</script>
