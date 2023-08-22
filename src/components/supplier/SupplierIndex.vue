<template>
  <div class="container">
    <div class="row">
      <router-link to="{name:'SupplierCreate'}" class="btn btn-primary"
        >Add Supplier</router-link
      >
    </div>
    <br />
    <input
      type="text"
      class="form-control"
      style="width: 300px"
      placeholder="Search Here"
      v-model="searh_term"
    />
    <br />

    <div class="row">
      <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card">
          <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
          >
            <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Shop Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="supplier_all_data.length > 0">
                <tr
                  v-for="supplier in supplier_filter_search"
                  :key="supplier.id"
                >
                  <td>{{ supplier.name }}</td>
                  <td>
                    <img
                      :src="`http://127.0.0.1:8000/${supplier.photo}`"
                      alt=""
                      style="width: 100px; height: 100px"
                    />
                  </td>
                  <td>{{ supplier.email }}</td>
                  <td>{{ supplier.shop_name }}</td>
                  <td>{{ supplier.phone }}</td>
                  <td>
                    <router-link
                      class="btn btn-sm btn-primary"
                      :to="{
                        name: 'SupplierEdit',
                        params: { id: supplier.id },
                      }"
                      >Edit</router-link
                    >
                    <a
                      class="btn btn-sm btn-danger"
                      @click="deleteSupplier(supplier.id)"
                      >Delete</a
                    >
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <p>Loading....</p>
              </tbody>
            </table>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </div>
    <!--Row-->
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      searh_term: "",
      supplier_all_data: [],
    };
  },

  methods: {
    async getSupplierAllData() {
      let result = await axios
        .get("http://127.0.0.1:8000/api/get_all_supplier", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          if (response.data.success) {
            this.supplier_all_data = response.data.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async deleteSupplier(id) {
      let result = await axios
        .delete("http://127.0.0.1:8000/api/delete_supplier/" + id, {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          if (response.data.success) {
            this.getSupplierAllData();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  computed: {
    supplier_filter_search() {
      return this.supplier_all_data.filter((supplier) => {
        //match character upper case and lower case
        const pattern = new RegExp(this.searh_term, "i");
        return supplier.name.match(pattern);
      });
    },
  },

  created() {
    this.getSupplierAllData();
  },
};
</script>

<style></style>
