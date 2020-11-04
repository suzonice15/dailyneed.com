<template>
    <div>
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Product</h2>
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
        <section class="content"   >


            <form @submit.prevent="UpdateCategory()"  enctype="multipart/form-data">

                <div class="container-fluid" >
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">

                                    <h6 class="card-title">Edit  Product</h6>


                                </div>
                                <div class="card-body">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6> Basic Product Information</h6>
                                        </div>


         <div class="row"  style="padding: 10px;">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                    <label for="product_title">Product Title<span
                                                                class="required">*</span></label>
                                                    <input  type="text" class="form-control"
                                                           v-model="form.product_title" id="product_title"
                                                           value="" :class="{ 'is-invalid': form.errors.has('product_title') }" autocomplete="off">
                                                            <has-error :form="form" field="product_title"></has-error>

                                                </div>

                                                <div class="form-group ">
                                                    <label for="product_name">Permalink<span class="required"> *</span></label>
                                                    <input   type="text" class="form-control the_name"
                                                            v-model="form.product_name" id="product_name"
                                                           value="" :class="{ 'is-invalid': form.errors.has('product_name') }" autocomplete="off">
                                                              <has-error :form="form" field="product_name"></has-error>


                                                </div>
                                                <input  type="hidden" class="form-control"
                                                          v-model="form.folder" id="folder"
                                                        value="" >
                                                <div class="form-group " style="margin-top: -12px;">
                                                    <label for="sku">Product Code(sku)<span class="required">*</span></label>
                                                    <input autocomplete="off" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('sku') }"  v-model="form.sku" id="sku"
                                                           value="" >
                                                             <has-error :form="form" field="sku"></has-error>


                                                </div>

                                                <div  class="form-group ">
                                                    <label for="product_video">Youtube Video Link</label>
                                                    <input type="text" class="form-control"  v-model="form.product_video"
                                                           id="product_video" value="" autocomplete="off">
                                                </div>

                                                <div  class="form-group">
                                                    <label for="website">Website</label>
                                                    <input type="text" class="form-control"  v-model="form.website"
                                                           id="website" value="" autocomplete="off">
                                                </div>
                                            </div>


                                            <div  style="margin-left: 8px;" class="col-sm-2">



                                                <div
                                                        class="form-group">
                                                    <label for="purchase_price">Purchase Price<span
                                                                class="required">*</span></label>
                                                    <input type="number" class="form-control"  v-model="form.purchase_price"
                                                           id="purchase_price"
                                                           value="" autocomplete="off">
                                                </div>

                                                <div class="form-group ">
                                                    <label for="sell_price">Regular Price<span class="required">*</span></label>
                                                    <input   :class="{ 'is-invalid': form.errors.has('product_price') }"   type="number" class="form-control"  v-model="form.product_price"
                                                           id="product_price" value="" autocomplete="off">
                                                            <has-error :form="form" field="product_price"></has-error>

                                                </div>


                                                <div class="form-group ">
                                                    <label for="discount_price"> Discount Price</label>
                                                    <input type="number" class="form-control"  v-model="form.discount_price"
                                                           id="discount_price"
                                                           value="" >
                                                </div>



                                                <div class="form-group ">
                                                    <label for="stock_qty">Stock Qty.</label>
                                                    <input type="number" class="form-control"  v-model="form.product_stock" id="product_stock"
                                                           value="" autocomplete="off">
                                                </div> </div>
                                            <div style="margin-left: 31px;" class="col-sm-3">




                                                <div class="form-group ">
                                                    <label for="product_availability"> Published
                                                        Status</label> <select  v-model="form.status"
                                                                               class="form-control">
                                                        <option value="1">Published</option>
                                                        <option value="0">Unpublished</option>
                                                    </select></div>



                                                <div class="form-group ">
                                                    <label for="product_type">Product Location</label>
                                                    <select  v-model="form.product_type" id="product_type"
                                                            class="form-control">
                                                        <option value="general">General</option>
                                                        <option value="first">First Hot Sell</option>
                                                        <option value="last">Last Hot Sell</option>
                                                    </select>

                                                </div>



                                                <div class="form-group ">
                                                    <label for="discount_price">Delivery Charge Inside Dhaka</label>
                                                    <input type="number" class="form-control"  v-model="form.delivery_in_dhaka"
                                                           id="delivery_in_dhaka"
                                                           value="" autocomplete="off">
                                                </div>
                                                <div class="form-group ">
                                                    <label for="discount_price">Delivery Charge Outside Dhaka</label>
                                                    <input type="number" class="form-control"  v-model="form.delivery_out_dhaka"
                                                           id="delivery_out_dhaka"
                                                           value="" autocomplete="off">
                                                </div>

                                            </div>


                                        </div>


                                    </div>

                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6>Category and Image Information</h6>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group" style="margin-left:15px;margin-top:5px">



<div class="first" v-for="first in categories" :key="first.category_id">
                                                    <input type="checkbox"  name="category_id[]"  v-model="form.category_id" :value="first.category_id">{{first.category_title}}
   <br>




</div>
            </div>


                                            </div>

                                            <div class="col-md-6">
                                              <label>Featured Image<span class="required">  Size(700*700)</span></label>

                                            <table class="table table-bordered">
                                            <tr>
                                            <td> <input @change = "changePhoto($event)" type="file"  accept="image/*"  name="photo" :class="{ 'is-invalid': form.errors.has('photo') }">
</td>
                                            <td>  <img     :src="form.baseUrl+'public/uploads/'+form.folder+'/small/'+photo_edit"  alt="" width="80" height="50"></td>
                                            </tr>
                                             <tr> <td colspan="2"> <has-error :form="form" field="photo"></has-error></td></tr>
                                            </table>



                                                <div class="form-group" style="margin-top: 0px;">
                                                    <label>Product Gallary<span class="required">* Size(700*700)</span></label>

                                                      <table class="table table-bordered">
                                                           <tr>
                                                           <td> <input @change = "changePhoto1($event)"  accept="image/*" name="photo1" type="file" :class="{ 'is-invalid': form.errors.has('photo1') }">
                                                           </td>
                                                             <td><img :src="form.photo1" alt="" width="80" height="50"></td>
                                                            </tr>
                                                             <tr> <has-error :form="form" field="photo1"></has-error>
                                                             </tr>

                                        <tr><td> <input @change = "changePhoto2($event)"   accept="image/*" name="photo2" type="file" :class="{                                                        'is-invalid': form.errors.has('photo2') }">
                                                     </td>
                                                     <td><img :src="form.photo2" alt="" width="80" height="50"></td>
                                                       </tr>
                                                     <tr> <has-error :form="form" field="photo2"></has-error>
                                                   </tr>

                                                    <tr><td> <input @change = "changePhoto3($event)" name="photo3" type="file" :class="{                                                        'is-invalid': form.errors.has('photo2') }">
                                                                                                        </td>
                                                                                                        <td><img :src="form.photo3" alt="" width="80" height="50"></td>
                                                                                                          </tr>
                                                                                                        <tr> <has-error :form="form" field="photo3"></has-error>
                                                                                                      </tr>
 <tr><td> <input @change = "changePhoto4($event)" name="photo4" type="file" :class="{                                                        'is-invalid': form.errors.has('photo4') }">
                                                     </td>
                                                     <td><img :src="form.photo4" alt="" width="80" height="50"></td>
                                                       </tr>
                                                     <tr> <has-error :form="form" field="photo4"></has-error>
                                                   </tr>



                                </table>



                                                </div>

                                            </div>



                                        </div>


                                    </div>


                                    <div class="card card-default">
                                        <div class="card-header">
                                            <h6>Product Description</h6>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12" style="padding:23px;">
                                                <div class="form-group ">
                <textarea   class="form-control ckeditor" rows="10"   v-model="form.product_description"
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
                                                    <label for="seo_title"> SEO Title</label>
                                                    <input  autocomplete="off" type="text" class="form-control" v-model="form.seo_title" name="seo_title" id="seo_title"
                                                            value="">
                                                </div>

                                                <div class="form-group ">
                                                    <label for="seo_keywords">SEO Keywords</label>
                                                    <input   autocomplete="off" type="text"
                                                             class="form-control"
                                                             name="seo_keywords"
                                                             id="seo_keywords"
                                                             value="" v-model="form.seo_keywords">
                                                </div>

                                                <div class="form-group "><label for="seo_meta_content"> SEO
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

                categories:"",
                secondCategories:"",
 photo_edit:"",
                form: new Form({
                    product_title: "",
                    product_name: "",
                    product_type: "general",
                    status: 1,
                    product_description: "",
                    delivery_in_dhaka:"" ,
                    delivery_out_dhaka:"" ,
                    sku: "",
                    category_id:[],
                    photo: '',

                      baseUrl: "http:\/\/localhost:\/dailyneed.com\/",
                    photo_true:false,
                    photo1: "",
                    folder:"",
                    photo2: "",
                    photo3: "",
                    photo4: "",
                    seo_title: "",
                    seo_keywords: "",
                    seo_description:"",
                }),

            }
        },


        mounted(){
            this.FirstCategoryList();
axios.get(`/api/product/${this.$route.params.id}`).then((response)=>{

                                      console.log(response);
                                      this.form.folder=response.data.data.folder;
                                      this.photo_edit=response.data.data.feasured_image;
                                       this.form.fill(response.data.data)
                                     })

        },


        methods:{
UpdateCategory(){
                           this.form.put(`/api/product/${this.$route.params.id}`)
                               .then((response)=> {
                               Toast.fire({
                                   icon: 'success',
                                   title: 'product  Updated  successfully'
                               })
                               this.$router.push('/admin/products')
                           })


                       },
            FirstCategoryList(){
                axios.get("/api/FirstCategoryList").then(response=>{
                    this.categories=response.data.category;


            })  .catch(e => {

                    this.$Progress.fail();
            });
            },


            changePhoto(event){
                            let file = event.target.files[0];
                                            let reader = new FileReader();

 var vm = this;
                if(file['size'] < 2111775)
                {
                    reader.onloadend = (file) => {
                  //  console.log('RESULT', reader.result)
                     vm.form.photo = reader.result;
                    }
                     reader.readAsDataURL(file);
                }else{
                    alert('File size can not be bigger than 2 MB')
                }
                        },
                          changePhoto1(event){
                                                    let file = event.target.files[0];

                                                         let reader = new FileReader();
                                                         reader.onload = event => {
                                                             this.form.photo1 = event.target.result

                                                         };
                                                         reader.readAsDataURL(file);

                                                },


                                                 changePhoto2(event){
                                                                                                    let file = event.target.files[0];

                                                                                                         let reader = new FileReader();
                                                                                                         reader.onload = event => {
                                                                                                             this.form.photo2 = event.target.result

                                                                                                         };
                                                                                                         reader.readAsDataURL(file);

                                                                                                },
                                                                                                 changePhoto3(event){
                                                                                                                                                    let file = event.target.files[0];

                                                                                                                                                         let reader = new FileReader();
                                                                                                                                                         reader.onload = event => {
                                                                                                                                                             this.form.photo3 = event.target.result

                                                                                                                                                         };
                                                                                                                                                         reader.readAsDataURL(file);

                                                                                                                                                }, changePhoto4(event){
                                                                                                                                                                                                      let file = event.target.files[0];

                                                                                                                                                                                                           let reader = new FileReader();
                                                                                                                                                                                                           reader.onload = event => {
                                                                                                                                                                                                               this.form.photo4 = event.target.result

                                                                                                                                                                                                           };
                                                                                                                                                                                                           reader.readAsDataURL(file);

                                                                                                                                                                                                  },
             secondCategory(category_id){
                            axios.get("/api/SecondCategoryList/"+category_id).then(response=>{
                                this.secondCategories=response.data.category;
                        })  .catch(e => {
                                this.$Progress.fail();
                        });
                        },




        }


    }
</script>