<template>
  <div>
    <Layout v-if="$route.name !== 'Login' && $route.name !== 'Register'">
      <router-view></router-view>
    </Layout>
    <router-view v-else></router-view>
  </div>
</template>

<script>
import Layout from "./components/Layout.vue";
import Login from "./components/Auth/Login.vue";

export default {
  components: {
    Layout,
    Login,
  },
};
</script>

<style></style>
