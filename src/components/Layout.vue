<template>
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="index.html"
      >
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png" />
        </div>
        <div class="sidebar-brand-text mx-3">RuangAdmin</div>
      </a>
      <hr class="sidebar-divider my-0" />
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span></a
        >
      </li>

      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-bs-toggle="collapse"
          data-bs-target="#collapseBootstrap"
          aria-expanded="true"
          aria-controls="collapseBootstrap"
        >
          <i class="bi bi-window"></i>
          <span>Employee</span>
        </a>
        <div
          id="collapseBootstrap"
          class="collapse"
          aria-labelledby="headingBootstrap"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <router-link
              style="cursor: pointer"
              class="collapse-item"
              :to="{ name: 'EmployeeCreate' }"
              >Add Employee</router-link
            >
            <router-link
              style="cursor: pointer"
              :to="{ name: 'EmployeeIndex' }"
              class="collapse-item"
              >All Employee</router-link
            >
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="forms.html">
          <i class="bi bi-clipboard-data"></i>
          <span>Forms</span>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-bs-toggle="collapse"
          data-bs-target="#collapseTable"
          aria-expanded="true"
          aria-controls="collapseTable"
        >
          <i class="bi bi-table"></i>
          <span>Tables</span>
        </a>
        <div
          id="collapseTable"
          class="collapse"
          aria-labelledby="headingTable"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
            <a class="collapse-item" href="datatables.html">DataTables</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ui-colors.html">
          <i class="bi bi-palette"></i>
          <span>UI Colors</span>
        </a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">Examples</div>
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          href="#"
          data-bs-toggle="collapse"
          data-bs-target="#collapsePage"
          aria-expanded="true"
          aria-controls="collapsePage"
        >
          <i class="bi bi-columns"></i>
          <span>Pages</span>
        </a>
        <div
          id="collapsePage"
          class="collapse"
          aria-labelledby="headingPage"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Example Pages</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="bi bi-graph-up"></i>
          <span>Charts</span>
        </a>
      </li>
      <hr class="sidebar-divider" />
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav
          class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top"
        >
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown no-arrow">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <img
                  class="img-profile rounded-circle"
                  src="img/boy.png"
                  style="max-width: 60px"
                />
                <span class="ml-2 d-none d-lg-inline text-white small"
                  >Maman Ketoprak</span
                >
              </a>
              <div
                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown"
              >
                <a class="dropdown-item" href="#">
                  <i class="bi bi-person fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-gear fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="bi bi-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a
                  class="dropdown-item"
                  style="cursor: pointer"
                  @click="logout"
                >
                  <i
                    class="bi bi-box-arrow-right fa-sm fa-fw mr-2 text-gray-400"
                  ></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <main>
          <div class="container-fluid" id="container-wrapper">
            <router-view></router-view>
          </div>
        </main>
        <!---Container Fluid-->
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {};
  },
  methods: {
    async logout() {
      console.log("logout");
      let result = await axios
        .get("http://127.0.0.1:8000/api/user_logout", {
          headers: {
            Authorization: `bearer ${localStorage.getItem("user-token")}`,
          },
        })
        .then((response) => {
          if (response.data.success) {
            localStorage.removeItem("user-token");
            this.$router.push({ name: "Login" });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {
    let user = localStorage.getItem("user-token");
    if (!user) {
      this.$router.push({ name: "Login" });
    }
  },
};
</script>

<style>

</style>
