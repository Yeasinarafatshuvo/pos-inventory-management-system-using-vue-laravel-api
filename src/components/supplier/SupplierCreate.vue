<template>
  <div>
    <div class="row">
      <router-link :to="{ name: 'SupplierIndex' }" class="btn btn-primary">
        All Supplier
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
                    <h1 class="h4 text-gray-900 mb-4">Add Supplier</h1>
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
                            placeholder="Enter Your Phone Number"
                            v-model="phone"
                          />
                          <span class="text-danger">{{ phone_error }}</span>
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
                            placeholder="Enter Your Shop Name"
                            v-model="shop_name"
                          />
                          <span class="text-danger">{{ shop_name_error }}</span>
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
                        @click="create_employee"
                      >
                        Submit
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
export default {
  name: "SupplierCreate.vue",

  data() {
    return {
      data() {
        return {
          name: "",
          email: "",
          address: "",
          phone: "",
          photo: "",
          shop_name: "",
          name_error: "",
          email_error: "",
          address_error: "",
          phone_error: "",
          shop_name_error: "",
        };
      },
    };
  },

  methods: {
    addImageFile() {},
    async create_employee() {},
  },
};
</script>

<style></style>
