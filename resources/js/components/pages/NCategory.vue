<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="#1867c0" dark v-bind="attrs" v-on="on">
          NEW CATEGORY
        </v-btn>
      </template>
      <v-card>
        <form>
          <v-card-title>
            <span class="headline">NEW CATEGORY</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    v-model="category.name"
                    label="Name*"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
            <small>*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click="addCategory">Save</v-btn>
          </v-card-actions>
        </form>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import Category from "../../Apis/Category";

export default {
  data() {
    return {
      dialog: false,
      category: {
        id: 0,
        name: ""
      }
    };
  },
  methods: {
    addCategory: function() {
      Category.addCategory(this.category)
        .then(response => {
          this.category = {
            id: 0,
            name: ""
          };

          Toast.fire({
            type: "success",
            title: "Category has been added."
          });
          this.dialog = false;
          this.$parent.allCategorys();
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  mounted() {},
  watch: {}
};
</script>
