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
                  <th>Phone</th>
                  <th>Shop Name</th>
                  <th>Action</th>
                </tr>
              </thead>
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
export default {};
</script>

<style></style>
