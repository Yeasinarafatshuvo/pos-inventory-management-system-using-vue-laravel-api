<template>
  <div class="container">
    <div class="row">
      <router-link to="{name:'EmployeeCreate'}" class="btn btn-primary"
        >Add Employee</router-link
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
            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Name</th>
                  <th>Photo</th>
                  <th>Phone</th>
                  <th>Salary</th>
                  <th>Joining Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody v-if="employeeAllData.length > 0">
                <tr
                  v-for="employee in employee_filter_search"
                  :key="employee.id"
                >
                  <td>{{ employee.name }}</td>
                  <td>
                    <img
                      :src="`http://127.0.0.1:8000/${employee.photo}`"
                      alt=""
                      style="width: 100px; height: 100px"
                    />
                  </td>
                  <td>{{ employee.phone }}</td>
                  <td>{{ employee.salary }}</td>
                  <td>{{ employee.joining_date }}</td>
                  <td>
                    <router-link
                      :to="{
                        name: 'Employee_edit',
                        params: { id: employee.id },
                      }"
                      class="btn btn-sm btn-primary"
                      >Edit</router-link
                    >
                    <a
                      @click="deleteEmployee(employee.id)"
                      class="btn btn-sm btn-danger"
                      ><font color="#ffffff">Delete</font></a
                    >
                  </td>
                </tr>
              </tbody>
              <tbody v-else>
                <p>Loading......</p>
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
  name: "EmployeeIndex",
  data() {
    return {
      employeeAllData: [],
      searh_term: "",
    };
  },
  computed: {
    employee_filter_search() {
      return this.employeeAllData.filter((employee) => {
        const pattern = new RegExp(this.searh_term, "i");
        return employee.name.match(pattern);
      });
    },
  },

  methods: {
    async getAllEmployeeData() {
      let result = await axios
        .get("http://127.0.0.1:8000/api/getAllEmployee", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          if (response.data.success) {
            this.employeeAllData = response.data.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async deleteEmployee(id) {
      if (id) {
        let result = await axios
          .delete("", {})
          .then((response) => {})
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },

  created() {
    this.getAllEmployeeData();
  },
};
</script>

<style></style>
