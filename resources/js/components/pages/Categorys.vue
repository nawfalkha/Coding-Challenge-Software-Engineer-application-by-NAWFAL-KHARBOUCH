<template>
  <div>
    <v-container class="grey lighten-5">
      <v-row class="mb-6" no-gutters>
        <v-col v-if="loading" cols="12" sm="12" style="text-align: center;">
          <v-progress-circular indeterminate color="#c01818"></v-progress-circular>
        </v-col>
        <v-col v-else cols="12" sm="12">
          <div data-app>
            <NCategory></NCategory>
          </div>

          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">ID</th>
                  <th class="text-left">NAME</th>
                  <th class="text-left"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categorys" :key="category.name">
                  <td>
                    <v-chip class="ma-2" color="#5cbbf6">
                      {{ category.id }}
                    </v-chip>
                  </td>
                  <td>{{ category.name }}</td>
                  <td>
                    <v-btn
                      class="ma-2"
                      tile
                      outlined
                      style="color:red;"
                      @click="destroyCategory(category.id)"
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
import Category from "../../Apis/Category";

export default {
  data() {
    return {
      categorys: [],
      loading: true
    };
  },
  methods: {
    allCategorys: function() {
      this.categorys = [];
      this.loading = true;
      Category.allcategorys()
        .then(response => {
          this.categorys = response.data.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
        });
    },
    destroyCategory: function(id) {
      Category.destroy(id)
        .then(response => {
          this.allCategorys();
          Toast.fire({
            type: "success",
            title: "Category deleted successfully"
          });
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {
    this.allCategorys();
  },
  watch: {}
};
</script>
