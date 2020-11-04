<template>
<div>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Product</li>

                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">


               <router-link class="btn btn-sm btn-success" to='/admin/product/create'>Add  Product</router-link>
                            <button type="button" class="btn btn-sm btn-primary" @click="reload">
                              Reload
                              <i class="fa fa-sync"></i>
                            </button>


                    </div>
                    <div class="card-body">
                      <div class="card-body ">
                       <div class="mb-3">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <strong>Search By :</strong>
                                      </div>

                                      <div class="col-md-4">
                                        <select v-model="searchFiled" class="form-control" id="fileds">
                                          <option value="product_title">Product Name</option>
                                          <option value="product_name">Product Parmalink</option>
                                          <option value="sku">Product  Code</option>

                                        </select>
                                      </div>
                                      <div class="col-md-5">
                                        <input v-model="searchItem" type="text" class="form-control" placeholder="Search">
                                      </div>
                                    </div>
                                  </div>
                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>Picture</th>
                                            <th>Product Name</th>
                                            <th>Code</th>
                                            <th>Purchase Price</th>
                                            <th>Sell Price </th>
                                            <th>Discount Price </th>
                                            <th>Stock</th>
                                            <th>Created Date</th>
                                            <th>Action</th>

                                          </tr>
                                        </thead>
                                         <tbody>
                                             <tr  v-show="products.length"  v-for="(product, index) in products">
                                                                        <td>{{index+1}}</td>
                                                                                    <td><img :src="baseUrl+'public/uploads/'+product.folder+'/small/'+product.feasured_image" ></td>
                                                                                   <td>{{product.product_title}}</td>
                                                                                   <td>{{product.sku}}</td>
                                                                                   <td>{{product.purchase_price}}</td>
                                                                                   <td>{{product.product_price}}</td>
                                                                                   <td>{{product.discount_price}}</td>
                                                                                   <td>{{product.product_stock}}</td>
                                                                                   <td>{{product.created_time}}</td>

                                                                                    <td>
                                                                                           <router-link :to="`/admin/product/edit/${product.product_id}`" class="btn btn-success">Edit</router-link>
                                                                                         <a title="delete" style="color:white"  class="btn btn-danger"   @click="destroy(product.product_id)">
                                                                                                      Delete
                                                                                        </a>
                                                                                          </td>

                                                 </td>
                                              </tr>

                                                <tr v-show="!products.length">
                                                                  <td colspan="6">
                                                                    <div class="alert alert-danger" role="alert">Sorry   No data found.</div>
                                                                  </td>
                                                                </tr>
                                     </tbody>

                                      </table>



      <pagination   v-if="pagination.last_page > 1"    :pagination="pagination"    :offset="5"

                                                                                 @paginate="searchItem === '' ? getData() : searchData()"     ></pagination>
                                    </div>
                                    </div>

                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

</div>
</template>

<script>
    export default {
    data() {
        return {
        baseUrl:Laravel.baseUrl,
        searchItem: "",
      searchFiled: "product_title",
          products: [],
          pagination: {
            current_page: 1
          }
        };
      },
watch: {
    searchItem: function(newQ, old) {
      if (newQ === "") {
        this.getData();
      } else {
   this.searchData();

      }
    }
  },
        mounted() {
              this.getData();
        },
         methods: {
                    getData() {

                      axios.get("/api/product?page=" + this.pagination.current_page)
                        .then(response => {

                          this.products = response.data.data;
                          this.pagination = response.data.meta;
                            this.$Progress.start();
                        })
                        .catch(e => {
                         this.$Progress.fail();
                        });
                    },
                    searchData() {
                          this.$Progress.start();
                          axios
                            .get(
                              "/api/search/product/" +
                                this.searchFiled +
                                "/" +
                                this.searchItem +
                                "?page=" +
                                this.pagination.current_page
                            )
                            .then(response => {
                              this.products = response.data.data;
                              console.log(response)
                              this.pagination = response.data.meta;
                              this.$Progress.finish();
                            })
                            .catch(e => {
                              this.$Progress.fail();
                            });
                        },
                         reload() {
                              this.getData();
                              this.searchItem = "";
                              this.searchFiled = "product_title";
                            Toast.fire({
                               icon: 'success',
                               title: 'Data  successfully Refresh'
                                   })
                            },

                             destroy(category) {
                                    Toast.fire({
                                    title: 'Are you sure?',
                                     text: "You won't be able to revert this!",
                                     icon: 'warning',
                                     showCancelButton: true,
                                     confirmButtonButton: true,
                                     confirmButtonColor: '#3085d6',
                                     cancelButtonColor: '#d33',
                                     confirmButtonText: 'Yes, delete it!'
                                   }).then((result) => {
                                     if (result) {
                                     axios.delete("/api/category/"+category).then(response=>{
                                         this.getData();
                                      });
                                     }
                                });

           },

    },
    }
</script>