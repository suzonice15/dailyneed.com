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

                        <h4  class="card-title">Add New Category</h4>



                    </div>
                    <div class="card-body">
                    <div class="card card-default">
                                  <div class="card-header">
                                    <h3 class="card-title">Basic Category Information</h3>
                                  </div>

                                  <div class="row">
                                                                                             <div class="col-md-5 col-sm-12" style="margin-left: 10px">
                                                                                                 <div class="form-group">
                                                                                                     <label for="category_title">Category Name<span class="required">*</span></label>
                                                                                                     <input required type="text" id="category_title" class="form-control the_title"
                                                                                                            name="category_title" value="">
                                                                                                 </div>
                                                                                                 <!-- /.form-group -->
                                                                                                 <div class="form-group ">
                                                                                                     <label for="category_name">Parmalink<span class="required">*</span></label>
                                                                                                     <input required type="text" class="form-control the_name" id="category_name"
                                                                                                            name="category_name"
                                                                                                            value="">
                                                                                                     <span id="categoryError"></span>
                                                                                                 </div>


                                                                                             </div>
                                                                                             <!-- /.col -->
                                                                                             <div class="col-md-6 col-sm-12" style="margin-left: 20px">
                                                                                                 <div class="form-group">
                                                                                                     <label for="parent_id">Select Parent</label>
                                                                                                     <select required class="form-control select2 " name="parent_id"
                                                                                                             tabindex="-1"
                                                                                                             aria-hidden="true">
                                                                                                         <option value="0" style="background-color: red;">--- choose ---</option>


                                                                                                     </select>
                                                                                                 </div>
                                                                                                 <div class="form-group ">
                                                                                                     <label for="rank_order">Rank Order</label>
                                                                                                     <input type="text" class="form-control" name="rank_order" value="">
                                                                                                 </div>


                                                                                             </div>
                                                                                             <!-- /.col -->
                                                                                         </div>
                                                                                         <!-- /.row -->

                                </div>



                                  <div class="card card-default">
                                                                  <div class="card-header">
                                                                    <h3 class="card-title">Seo Information</h3>
                                                                  </div>

                                                                  <div class="row">

                                                                     <div class="col-md-12" style="
                                                                                                padding: 23px;
                                                                                            ">



                                                                           <div class="form-group">


                                                                                                                                    <label for="seo_title"> Title</label>
                                                                                                                                    <input type="text" class="form-control" name="seo_title" id="seo_title" value="">
                                                                                                                                </div>
                                                                                                                                <div class="form-group "><label for="seo_meta_title">SEO Meta Title</label> <input
                                                                                                                                            type="text" class="form-control" name="seo_meta_title" id="seo_meta_title" value="">
                                                                                                                                </div>

                                                                                                                                <div class="form-group "><label for="seo_meta_content"> Meta Description</label> <textarea
                                                                                                                                            class="form-control" rows="2" name="seo_meta_content"
                                                                                                                                            id="seo_meta_content"></textarea>
                                                                                                                                </div>
                                                                                                                                <div class="form-group "><label for="seo_keywords">Meta Keywords</label>
                                                                                                                                    <input type="text"
                                                                                                                                           class="form-control"
                                                                                                                                           name="seo_keywords"
                                                                                                                                           id="seo_keywords"
                                                                                                                                           value="">
                                                                                                                                </div>
                                                                                                                                <div class="form-group ">
                                                                                                                                    <label for="seo_content"> Content</label>
                                                                                                                                        <textarea    class="form-control"
                                                                                                                                                  rows="5" name="seo_content"
                                                                                                                                                  ></textarea>

                                                                                                                                </div>

                                                                                                                                  </div>
                                                                                                                                  </div>
                                                                                                                         <!-- /.row -->

                                                                </div>




                                               <div class="box-footer">
                                                   <input type="submit" class="btn btn-success pull-left" value="Save">

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

<script >
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>