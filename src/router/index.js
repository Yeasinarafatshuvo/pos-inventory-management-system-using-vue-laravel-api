import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Login from "../components/Auth/Login.vue";
import Register from "../components/Auth/Register.vue";

import EmployeeCreate from "../components/employee/EmployeeCreate.vue";
import EmployeeIndex from "../components/employee/EmployeeIndex.vue";
import Employee_edit from "../components/employee/Employee_edit.vue";
import SupplierCreate from "../components/supplier/SupplierCreate.vue";
import SupplierEdit from "../components/supplier/SupplierEdit.vue";
import SupplierIndex from "../components/supplier/SupplierIndex.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/login",
    name: "Login",
    component: Login,
  },
  {
    path: "/register",
    name: "Register",
    component: Register,
  },
  {
    path: "/employee/add-employee",
    name: "EmployeeCreate",
    component: EmployeeCreate,
  },
  {
    path: "/employee/all-employee",
    name: "EmployeeIndex",
    component: EmployeeIndex,
  },
  {
    path: "/employee/edit/:id",
    name: "Employee_edit",
    component: Employee_edit,
  },
  {
    path: "/supplier-create",
    name: "SupplierCreate",
    component: SupplierCreate,
  },
  {
    path: "/supplier-index",
    name: "SupplierIndex",
    component: SupplierIndex,
  },
  {
    path: "/supplier-edit/:id",
    name: "SupplierEdit",
    component: SupplierEdit,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
