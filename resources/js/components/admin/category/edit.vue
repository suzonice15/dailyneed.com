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


            <form @submit.prevent="UpdateCategory()" >

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">

                                    <h6 class="card-title">Edit Category</h6>


                                </div>
                                <div class="card-body">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6> Basic Category Information</h6>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                                                <div class="form-group">
                                                    <label for="category_title">Category Name<span class="required">*</span></label>

                                                    <input   type="text" id="category_title"
                                                           class="form-control"
                                                           name="category_title" v-model="form.category_title" :class="{ 'is-invalid': form.errors.has('category_title') }" autocomplete="off" value="">
                                                                                      <has-error :form="form" field="category_title"></has-error>


                                                </div>
                                                <!-- /.form-group -->
                                                <div class="form-group ">
                                                    <label for="category_name">Parmalink<span
                                                                class="required">*</span></label>
                                                    <input   type="text" class="form-control the_name"
                                                           id="category_name"
                                                           name="category_name"
                                                           v-model="form.category_name" :class="{ 'is-invalid': form.errors.has('category_name') }" value=""  autocomplete="off">
   <has-error :form="form" field="category_name"></has-error>
                                                </div>


                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6 col-sm-12" style="margin-left: 20px">
                                                <div class="form-group">
                                                    <label for="parent_id">Select Parent</label>
                                                    <select   class="form-control" v-model="form.parent_id" name="parent_id">
                                                      <option  :value="0"> Parent </option>
                                                        <option v-for="category in categories" :value="category.category_id">                                                 {{category.category_title }}
                                                        </option>


                                                    </select>

                                                </div>
                                                <div class="form-group ">
                                                    <label for="rank_order">Rank Order</label>
                                                    <input  autocomplete="off" type="text" class="form-control" v-model="form.rank_order"  :class="{ 'is-invalid': form.errors.has('rank_order') }" name="rank_order" value="">
                                                   <has-error :form="form" field="rank_order"></has-error>


                                                </div>


                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                    </div>


                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6>SEO Information</h6>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12" style="padding:23px;">
                                                <div class="form-group">
                                                    <label for="seo_title"> Meta Title</label>
                                                    <input  autocomplete="off" type="text" class="form-control" v-model="form.seo_title" name="seo_title" id="seo_title"
                                                           value="">
                                                </div>

                                                <div class="form-group ">
                                                    <label for="seo_keywords">Meta Keywords</label>
                                                    <input   autocomplete="off" type="text"
                                                           class="form-control"
                                                           name="seo_keywords"
                                                           id="seo_keywords"
                                                           value="" v-model="form.seo_keywords">
                                                </div>

                                                    <div class="form-group "><label for="seo_meta_content"> Meta
                                                            Description</label> <textarea
                                                                class="form-control" rows="2" v-model="form.seo_description"  name="seo_description"
                                                                id="seo_description"></textarea>
                                                    </div>


                                                <!-- /.row -->

                                                  <div class="box-footer">
                                                                                                <input type="submit" class="btn btn-success pull-left" value="Update">

                                                                                            </div>

                                            </div>





                                        </div>

                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
</div>
</div>
            </form>
        </section>
        <!-- /.content -->

    </div>
</template>

<script>
    export default {

      name: "edit",

        data() {


            return {

                categories:[],

                form: new Form({
                    category_title: "",
                    category_name: "",
                    parent_id: 0,
                    rank_order: "",
                    seo_title: "",
                    seo_keywords: "",
                    seo_description:"",
                }),

            }
        },
        mounted(){
            this.allCategories();
            console.log("mounted");
             axios.get(`/api/category/${this.$route.params.id}`).then((response)=>{

                              console.log(response);
                               this.form.fill(response.data.data)
                             })
        },
        methods:{

            allCategories(){
                axios.get("/api/allCategoryList").then(response=>{
                    this.categories=response.data.category;


            })  .catch(e => {

                    this.$Progress.fail();
            });
            },
             UpdateCategory(){
                           this.form.put(`/api/category/${this.$route.params.id}`)
                               .then((response)=> {
                               Toast.fire({
                                   icon: 'success',
                                   title: 'Category  Updated  successfully'
                               })
                               this.$router.push('/admin/category')
                           })


                       },


        }


    }
</script>