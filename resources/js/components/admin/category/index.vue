<template>
<div>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Category</li>

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


               <router-link class="btn btn-sm btn-success" to='/admin/cateogry/create'>Add  Category</router-link>
                            <button type="button" class="btn btn-sm btn-primary" @click="reload">
                              Reload
                              <i class="fa fa-sync"></i>
                            </button>


                    </div>
                    <div class="card-body">
                      <div class="card-body ">
                       <div class="mb-3">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <strong>Search By :</strong>
                                      </div>
                                      <div class="col-md-3">
                                        <select v-model="searchFiled" class="form-control" id="fileds">

                                          <option value="category_title">Category Title</option>
                                          <option value="category_name">Category Link</option>

                                        </select>
                                      </div>
                                      <div class="col-md-7">
                                        <input v-model="searchItem" type="text" class="form-control" placeholder="Search">
                                      </div>
                                    </div>
                                  </div>
                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Order By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>

                                          </tr>
                                        </thead>
                                         <tbody>
                                             <tr  v-show="categories.length"  v-for="(category, index) in categories">
                                                                        <td>{{index+1}}</td>
                                                                                   <td>{{category.category_title}}</td>
                                                                                   <td>{{category.rank_order}}</td>
                                                                                   <td>{{category.registered_date}}</td>


                                                                                    <td>
                                                                                       <a title="View" href="" style="color:white"  class="btn btn-info">  View     </a>

                                                                                                                                                                                                                                               <router-link :to="`/admin/category/edit/${category.category_id}`" class="btn btn-success">Edit</router-link>



                                                                                                   <a title="delete" style="color:white"  class="btn btn-danger"   @click="destroy(category.category_id)">
                                                                                                      Delete
                                                                                                   </a></td>

                                                 </td>
                                              </tr>

                                                <tr v-show="!categories.length">
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
 searchItem: "",
      searchFiled: "category_title",

          categories: [],
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

                      axios
                        .get("/api/category?page=" + this.pagination.current_page)
                        .then(response => {
                          this.categories = response.data.data;
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
                              "/api/search/category/" +
                                this.searchFiled +
                                "/" +
                                this.searchItem +
                                "?page=" +
                                this.pagination.current_page
                            )
                            .then(response => {

                              this.categories = response.data.data;
                              this.pagination = response.data.meta;
                              this.$Progress.finish();
                            })
                            .catch(e => {
                              console.log(e);
                              this.$Progress.fail();
                            });
                        },
                         reload() {
                              this.getData();
                              this.searchItem = "";
                              this.searchFiled = "category_title";
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