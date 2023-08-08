<template>
  <!-- Register Content -->
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-10 col-md-9">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center mb-4">
                    <h1 class="h4 text-gray-900">Register</h1>
                  </div>
                  <form @submit.prevent>
                    <div class="mb-3">
                      <label for="exampleInputFirstName" class="form-label"
                        >Enter Your Name</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="exampleInputFirstName"
                        placeholder="Enter Your Name"
                        v-model="name"
                      />
                      <span class="text-danger">{{ name_error }}</span>
                    </div>

                    <div class="mb-3">
                      <label for="exampleInputEmail" class="form-label"
                        >Email</label
                      >
                      <input
                        type="email"
                        class="form-control"
                        id="exampleInputEmail"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address"
                        v-model="email"
                      />
                      <span class="text-danger">{{ email_error }}</span>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword" class="form-label"
                        >Password</label
                      >
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPassword"
                        placeholder="Password"
                        v-model="password"
                      />
                      <span class="text-danger">{{ password_error }}</span>
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPasswordRepeat" class="form-label"
                        >Repeat Password</label
                      >
                      <input
                        type="password"
                        class="form-control"
                        id="exampleInputPasswordRepeat"
                        placeholder="Repeat Password"
                        v-model="password_confirmation"
                        @keyup="check_confirm_password"
                      />
                      <span class="text-danger">{{
                        password_confirmation_error
                      }}</span>
                    </div>
                    <div class="d-grid">
                      <button
                        type="submit"
                        class="btn btn-primary btn-block"
                        @click="register"
                      >
                        Register
                      </button>
                    </div>
                  </form>

                  <div class="text-center mt-3">
                    <a class="font-weight-bold small" href="login.html"
                      >Already have an account?</a
                    >
                  </div>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register Content -->
</template>

<script>
import axios from "axios";
export default {
  name: "Register",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      name_error: "",
      email_error: "",
      password_error: "",
      password_confirmation_error: "",
    };
  },
  methods: {
    async register() {
      let name = this.name.trim();
      let email = this.email.trim();
      let password = this.password.trim();
      let password_confirmation = this.password_confirmation.trim();

      if (!name) {
        this.name_error = "Enter Your Name";
      } else {
        this.name_error = "";
      }

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

      if (
        emailRegex.test(email) &&
        this.validatePassword(password) == 1 &&
        password === password_confirmation
      ) {
        console.log(name, email, password, password_confirmation);
        let result = await axios
          .post("http://127.0.0.1:8000/api/user_registration", {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          })
          .then((response) => {
            console.log(response);
            if (response.data.success) {
              this.$router.push({ name: "Login" });
              this.$toast.success(response.data.message, {
                duration: 1000,
                position: "top-right",
              });
            }
          })
          .catch((error) => {
            console.log(error);
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
    check_confirm_password() {
      let previous_password = this.password;
      let confirmation_password = this.password_confirmation;
      console.log(previous_password);
      if (previous_password !== confirmation_password) {
        this.password_confirmation_error = "Password Not Match";
      } else {
        this.password_confirmation_error = "";
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

<style></style>
