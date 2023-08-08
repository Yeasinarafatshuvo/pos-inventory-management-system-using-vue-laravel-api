<template>
  <div class="cener_div">
    <div class="login-form">
      <h3 class="text-center mb-4">Login</h3>
      <form @submit.prevent>
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="inputEmail"
            placeholder="Enter your email"
            v-model="email"
          />
          <span class="text-danger">{{ email_error }}</span>
        </div>
        <div class="mb-3">
          <label for="inputPassword" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="inputPassword"
            placeholder="Enter your password"
            v-model="password"
          />
          <span class="text-danger">{{ password_error }}</span>
        </div>
        <div class="mb-3">
          <button
            type="submit"
            class="btn btn-primary w-100"
            @click="admin_login"
          >
            Login
          </button>
        </div>
      </form>
      <div class="footer-links">
        <router-link :to="{ name: 'Register' }">Create an Account</router-link>
        |
        <a href="#">Forgot Password</a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      email_error: "",
      password_error: "",
    };
  },
  methods: {
    async admin_login() {
      let email = this.email.trim();
      let password = this.password.trim();

      //email validation start
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        this.email_error = "Enter Valid Email";
      } else {
        this.email_error = "";
      }
      //email validation end

      //password validation start
      if (this.validatePassword(password) !== 1) {
        this.password_error = this.validatePassword(password);
      } else {
        this.password_error = "";
      }
      //password validation end

      if (emailRegex.test(email) && this.validatePassword(password) == 1) {
        let result = await axios
          .post("http://127.0.0.1:8000/api/user_login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {
            if (response.data.success) {
              localStorage.setItem("user-token", response.data.access_token);
              this.$router.push({ name: "Home" });
              this.$toast.success(response.data.message, {
                duration: 1000,
                position: "top-right",
              });
            }
          })
          .catch((error) => {
            if (!error.response.data.success) {
              this.$toast.error(error.response.data.error, {
                duration: 1000,
                position: "top-right",
              });
            }
          });
      }
    },

    validatePassword(password) {
      switch (true) {
        case password.length < 6:
          return "Password Character Length at least 6";
        case !/[a-zA-Z]/.test(password):
          return "Password must contain at least one alphabet";
        case !/\d/.test(password):
          return "Password must contain at least one number";
        default:
          return 1;
      }
    },
  },

  mounted() {
    let user = localStorage.getItem("user-token");
    if (user) {
      this.$router.push({ name: "Home" });
    }
  },
};
</script>

<style scoped>
.cener_div {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url("/img/login_background.jpg");
  background-position: center;
  background-repeat: no-repeat;
}
.login-form {
  max-width: 400px;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.footer-links {
  text-align: center;
  margin-top: 20px;
}

.footer-links a {
  color: white;
}
</style>
