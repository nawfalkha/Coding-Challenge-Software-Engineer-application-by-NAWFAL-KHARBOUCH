<template>
  <header>
    <v-bottom-navigation :value="activeBtn" color="purple lighten-1">
      <v-btn>
        <span><router-link to="/" style="color:#000000">Home</router-link></span>
        <v-icon>mdi-home</v-icon>
      </v-btn>

      <v-btn>
        <span
          ><router-link to="/products" style="color:#000000"
            >Products</router-link
          ></span
        >
        <v-icon>mdi-bell</v-icon>
      </v-btn>

      <v-btn>
        <span
          ><router-link to="/categorys" style="color:#000000"
            >Categorys</router-link
          ></span
        >
        <v-icon>mdi-hexagon</v-icon>
      </v-btn>
    </v-bottom-navigation>
    <!-- Header End -->
  </header>
</template>

<script>
export default {
  data() {
    return {
      activeBtn: 1
    };
  },
  methods: {},
  mounted() {}
};
</script>
