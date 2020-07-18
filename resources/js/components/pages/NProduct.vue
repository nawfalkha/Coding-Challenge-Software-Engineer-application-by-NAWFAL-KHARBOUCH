<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="#1867c0" dark v-bind="attrs" v-on="on">
          NEW PRODUCT
        </v-btn>
      </template>
      <v-card>
        <form>
          <v-card-title>
            <span class="headline">NEW PRODUCT</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12" sm="6" md="6">
                  <v-text-field
                    v-model="product.name"
                    label="Name*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="6">
                  <v-text-field v-model="product.price" label="Price*"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    name="input-7-1"
                    label="Description*"
                    v-model="product.description"
                  ></v-textarea>
                </v-col>
                <v-col cols="12" sm="12">
                  <input
                    type="file"
                    ref="image"
                    accept="image/*"
                    @change="SelectedImageProduct"
                  />
                </v-col>
                <v-col cols="12" sm="12">
                  <v-select
                    :items="categorys"
                    label="Category"
                    v-model="product.category_id"
                    item-text="name"
                    item-value="id"
                  ></v-select>
                </v-col>
              </v-row>
            </v-container>
            <small>*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="addProduct">Save</v-btn>
          </v-card-actions>
        </form>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import Product from "../../Apis/Product";
import Category from "../../Apis/Category";

export default {
  data() {
    return {
      dialog: false,
      product: {
        id: 0,
        name: "",
        description: "",
        price: "",
        image: "",
        category_id: ""
      },
      categorys: []
    };
  },
  methods: {
    addProduct: function() {
      Product.addProduct(this.product)
        .then(response => {
          this.product = {
            id: 0,
            name: "",
            description: "",
            price: "",
            image: "",
            categorie_id: ""
          };

          Toast.fire({
            type: "success",
            title: "Product has been added."
          });
          this.dialog = false;
          this.$parent.allProducts();
        })
        .catch(error => {
          console.log(error);
        });
    },
    SelectedImageProduct(e) {
      const file = e.target.files[0];
      if (file) {
        var reader = new FileReader();
        if (file["size"] < 5111775) {
          reader.onloadend = file => {
            this.product.image = reader.result;
          };
          reader.readAsDataURL(file);
        } else {
          console.log("error");
        }
      }
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
    }
  },
  mounted() {
    this.allCategorys();
  },
  watch: {}
};
</script>
