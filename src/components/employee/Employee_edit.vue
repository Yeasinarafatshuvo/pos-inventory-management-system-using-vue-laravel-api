<template>
  <div>
    <div class="row">
      <router-link :to="{ name: 'EmployeeIndex' }" class="btn btn-primary">
        All Employee
      </router-link>
    </div>

    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Employee</h1>
                  </div>

                  <form
                    class="user"
                    @submit.prevent
                    enctype="multipart/form-data"
                  >
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Full Name"
                            v-model="name"
                          />
                          <span class="text-danger">{{ name_error }}</span>
                        </div>

                        <div class="col-md-6">
                          <input
                            type="email"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Email"
                            v-model="email"
                          />
                          <span class="text-danger">{{ email_error }}</span>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Address"
                            v-model="address"
                          />
                          <span class="text-danger">{{ address_error }}</span>
                        </div>

                        <div class="col-md-6">
                          <input
                            type="number"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Salary"
                            v-model="salary"
                          />
                          <span class="text-danger">{{ salary_error }}</span>
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <input
                            type="date"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Joining Date"
                            v-model="joining_date"
                          />
                          <span class="text-danger">{{
                            joining_date_error
                          }}</span>
                        </div>

                        <div class="col-md-6">
                          <input
                            type="text"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your NID"
                            v-model="nid"
                          />
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <input
                            type="number"
                            class="form-control"
                            id="exampleInputFirstName"
                            placeholder="Enter Your Phone Number"
                            v-model="phone"
                          />
                          <span class="text-danger">{{ phone_error }}</span>
                        </div>

                        <div class="col-md-6"></div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input"
                              id="customFile"
                              @change="addImageFile"
                            />
                            <label class="custom-file-label" for="customFile"
                              >Choose file</label
                            >
                          </div>
                        </div>

                        <div class="col-md-6">
                          <img :src="photo" style="height: 40px; width: 40px" />
                        </div>
                      </div>
                    </div>

                    <div class="mb-3">
                      <button
                        type="submit"
                        class="btn btn-primary btn-block"
                        @click="update_employee"
                      >
                        Update
                      </button>
                    </div>
                  </form>
                  <hr />
                  <div class="text-center"></div>
                  <div class="text-center"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { thistle } from "stylus/lib/colors";
export default {
  name: "EmployeeCreate",
  data() {
    return {
      name: "",
      email: "",
      address: "",
      phone: "",
      salary: "",
      nid: "",
      joining_date: "",
      photo: "",
      name_error: "",
      email_error: "",
      address_error: "",
      salary_error: "",
      joining_date_error: "",
      phone_error: "",
      photo_update: 0,
    };
  },
  methods: {
    addImageFile(event) {
      let file = event.target.files[0];
      if (file.size > 1048770) {
        this.$toast.error("File Size Should be less than 1 MB", {
          duration: 1000,
          position: "top-right",
        });
      } else {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.photo = event.target.result;
        };
        reader.readAsDataURL(file);
        this.photo_update = 1;
      }
    },

    async update_employee() {
      let name = this.name.trim();
      let email = this.email.trim();
      let address = this.address.trim();
      let phone = this.phone;
      let salary = this.salary;
      let nid = this.nid.trim();
      let photo = this.photo;
      let joining_date = this.joining_date;

      //validation start
      if (!name) {
        this.name_error = "Enter Valid Name";
      } else {
        this.name_error = "";
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        this.email_error = "Enter Valid Email";
      } else {
        this.email_error = "";
      }

      if (!phone) {
        this.phone_error = "Enter valid phone number";
      } else {
        this.phone_error = "";
      }

      if (!address) {
        this.address_error = "Enter a valid Address";
      } else {
        this.address_error = "";
      }

      if (!salary) {
        this.salary_error = "Enter a valid salary";
      } else {
        this.address_error = "";
      }

      if (!joining_date) {
        this.joining_date_error = "Enter Joining Date";
      } else {
        this.joining_date_error = "";
      }
      //validation end

      if (
        name &&
        emailRegex.test(email) &&
        phone &&
        address &&
        salary &&
        joining_date
      ) {
        console.log(typeof photo);
        let result = await axios
          .put(
            "http://127.0.0.1:8000/api/update_employee/" +
              this.$route.params.id,
            {
              name: name,
              email: email,
              address: address,
              phone: phone,
              salary: parseFloat(salary),
              nid: nid,
              joining_date: new Date(this.joining_date)
                .toISOString()
                .split("T")[0],
              photo: this.photo,
              photo_update: this.photo_update,
            },
            {
              headers: {
                Authorization: `bearer ${localStorage.getItem("user-token")}`,
              },
            }
          )
          .then((response) => {
            console.log(response);
            if (response.data.success) {
              this.$router.push({ name: "EmployeeIndex" });
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

    async get_specefic_employee() {
      let result = await axios
        .get(
          "http://127.0.0.1:8000/api/employee_specefic_data/" +
            this.$route.params.id,
          {
            headers: {
              Authorization: `bearer ${localStorage.getItem("user-token")}`,
            },
          }
        )
        .then((response) => {
          if (response.data.success) {
            this.name = response.data.data.name;
            this.email = response.data.data.email;
            this.address = response.data.data.address;
            this.phone = response.data.data.phone;
            this.salary = response.data.data.salary;
            this.nid = response.data.data.nid;
            this.joining_date = response.data.data.joining_date;
            this.photo = "http://127.0.0.1:8000/" + response.data.data.photo;
          }
        })
        .catch((error) => {});
    },
  },

  created() {
    this.get_specefic_employee();
  },
};
</script>

<style></style>
