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


            <form @submit.prevent="store()" >

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">

                                    <h6 class="card-title">Add New Product</h6>


                                </div>
                                <div class="card-body">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6> Basic Product Information</h6>
                                        </div>


                                        <div class="row">
                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label for="product_title">Product Title<span
                                                                class="required">*</span></label>
                                                    <input required type="text" class="form-control the_title"
                                                           name="product_title" id="product_title"
                                                           value="" autocomplete="off">
                                                </div>

                                                <div class="form-group ">
                                                    <label for="product_name">Permalink<span class="required">*</span></label>
                                                    <input required type="text" class="form-control the_name"
                                                           name="product_name" id="product_name"
                                                           value="" autocomplete="off">
                                                    <p id="produtctError"></p>
                                                </div>
                                                <input  type="hidden" class="form-control"
                                                        name="folder" id="folder"
                                                        value="" >
                                                <div class="form-group " style="margin-top: -12px;">
                                                    <label for="sku">Product Code(sku)<span class="required">*</span></label>
                                                    <input required type="text" class="form-control" name="sku" id="sku"
                                                           value="<?php echo $sku;?>" autocomplete="off">
                                                    <span class="text-danger" id="sku_error"></span>
                                                </div>

                                                <div  class="form-group ">
                                                    <label for="product_video">Youtube Video Link</label>
                                                    <input type="text" class="form-control" name="product_video"
                                                           id="product_video" value="" autocomplete="off">
                                                </div>

                                                <div  class="form-group">
                                                    <label for="website">Website</label>
                                                    <input type="text" class="form-control" name="website"
                                                           id="website" value="" autocomplete="off">
                                                </div>
                                            </div>


                                            <div  style="margin-left: 8px;" class="col-sm-2">



                                                <div
                                                        class="form-group">
                                                    <label for="purchase_price">Purchase Price<span
                                                                class="required">*</span></label>
                                                    <input type="text" class="form-control" name="purchase_price"
                                                           id="purchase_price"
                                                           value="" autocomplete="off">
                                                </div>

                                                <div class="form-group ">
                                                    <label for="sell_price">Regular Price<span class="required">*</span></label>
                                                    <input required type="text" class="form-control" name="product_price"
                                                           id="product_price" value="" autocomplete="off">
                                                </div>


                                                <div class="form-group ">
                                                    <label for="discount_price"> Discount Price</label>
                                                    <input type="text" class="form-control" name="discount_price"
                                                           id="discount_price"
                                                           value="" autocomplete="off">
                                                </div>



                                                <div class="form-group ">
                                                    <label for="stock_qty">Stock Qty.</label>
                                                    <input type="text" class="form-control" name="product_stock" id="product_stock"
                                                           value="" autocomplete="off">
                                                </div> </div>
                                            <div style="margin-left: 31px;" class="col-sm-3">




                                                <div class="form-group ">
                                                    <label for="product_availability"> Published
                                                        Status</label> <select name="status"
                                                                               class="form-control">
                                                        <option value="1">Published</option>
                                                        <option value="0">Unpublished</option>
                                                    </select></div>



                                                <div class="form-group ">
                                                    <label for="product_type">Product Location</label>
                                                    <select name="product_type" id="product_type"
                                                            class="form-control">
                                                        <option value="general">General</option>
                                                        <option value="first">First Hot Sell</option>
                                                        <option value="last">Last Hot Sell</option>
                                                    </select>

                                                </div>



                                                <div class="form-group ">
                                                    <label for="discount_price">Delivery Charge Inside Dhaka</label>
                                                    <input type="text" class="form-control" name="delivery_in_dhaka"
                                                           id="discount_price"
                                                           value="<?= get_option('shipping_charge_in_dhaka') ?>" autocomplete="off">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="discount_price">Delivery Charge Outside Dhaka</label>
                                                    <input type="text" class="form-control" name="delivery_out_dhaka"
                                                           id="discount_price"
                                                           value="<?= get_option('shipping_charge_out_of_dhaka') ?>" autocomplete="off">
                                                </div>



                                            </div>


                                        </div>


                                    </div>

                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6>SEO Information</h6>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php




                                                    if (isset($categories)) {
                                                    foreach ($categories as $category) {


                                                    $subCategory_id = $category->category_id;
                                                    $subCategories=DB::table('category')->where('parent_id',$subCategory_id)->orderBy('category_id','ASC')->get();


                                                    ?>
                                                    <input type="checkbox"   name="category_id[]" value="<?php echo $category->category_id;?>">
                                                    <span><?php echo $category->category_title;?></span>
                                                    <br>
                                                    <?php

                                                    if($subCategories) {
                                                    foreach ($subCategories as $subCategory) {

                                                    $childCategory_id = $subCategory->category_id;
                                                    $childCategories=DB::table('category')->where('parent_id',$childCategory_id)->orderBy('category_id','ASC')->get();

                                                    ?>



                                                    <input type="checkbox"  style="margin-left: 30px" name="category_id[]" value="<?php echo $subCategory->category_id;?>">
                                                    <span><?php echo $subCategory->category_title;?></span>
                                                    <br/>

                                                    <?php

                                                    if($childCategories){
                                                    foreach ($childCategories as $childCategory) {
                                                    ?>
                                                    <input type="checkbox"  style="margin-left: 60px" name="category_id[]" value="<?php echo $childCategory->category_id;?>">
                                                    <span><?php echo $childCategory->category_title;?></span>
                                                    <br/>

                                                    <?php
                                                    }
                                                    }  }

                                                    }

                                                    }


                                                    }


                                                    ?>
                                                </div>


                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group featured-image">
                                                    <label>Featured Image<span class="required">* Size(700*700)</span></label>
                                                    <input  required type="file" class="form-control" name="featured_image"/>

                                                </div>

                                                <div class="form-group" style="margin-top: -51px;">
                                                    <label>Product Gallary<span class="required">* Size(700*700)</span></label>
                                                    <input type="file" class="form-control" name="product_image1"/>
                                                    <br>
                                                    <input type="file" class="form-control" name="product_image2"/>
                                                    <br>
                                                    <input type="file" class="form-control" name="product_image3"/>
                                                    <br>
                                                    <input type="file" class="form-control" name="product_image4"/>
                                                    <br>
                                                    <input type="file" class="form-control" name="product_image5"/>
                                                    <br>
                                                    <input type="hidden" class="form-control" name="product_image6"/>
                                                    <br>
                                                    <input type="hidden" class="form-control" name="product_image7"/>
                                                    <br>
                                                    <br>


                                                </div>

                                            </div>



                                        </div>


                                    </div>


                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6>SEO Information</h6>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12" style="padding:23px;">



                                                <div class="form-group ">
                <textarea   class="form-control ckeditor" rows="10" name="product_description"
                            id="product_description"></textarea>
                                                </div>

                                            </div>





                                        </div>


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
                                                    <input type="submit" class="btn btn-success pull-left" value="Save">

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

        name: "create",
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
        },
        methods:{

            allCategories(){
                axios.get("/api/allCategoryList").then(response=>{
                    this.categories=response.data.category;

                console.log(response);
            })  .catch(e => {

                    this.$Progress.fail();
            });
            },
            store() {
                this.$Progress.start();
                this.form.post("/api/category").then(response => {
                    this.form.reset();
                this.$Progress.finish();
                Toast.fire({
                    icon: 'success',
                    title: 'Category Added  successfully '
                })
            }).catch(e => {
                    this.$Progress.fail();
                console.log(e);
            });
            },


        }


    }
</script>