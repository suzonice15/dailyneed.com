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

                        <h4  class="card-title"><router-link class="btn btn-success" to='/admin/cateogry/create'>Add New Category</router-link> </h4>



                    </div>
                    <div class="card-body">
                      <div class="card-body">
                                      <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th style="width: 10px">Sl</th>
                                            <th>Category Name</th>
                                            <th>Order By</th>
                                            <th>Created Date</th>
                                            <th>Action</th>

                                          </tr>
                                        </thead>
                                         <tbody>

                                                                                 <tr>
                                                                                   <td>1.</td>
                                                                                   <td>Update software</td>
                                                                                   <td>
                                                                                     <div class="progress progress-xs">
                                                                                       <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                                                                     </div>
                                                                                   </td>
                                                                                   <td>
                                                                                    <td>
                                                                                                   <a title="edit" href="">
                                                                                                       <span class="glyphicon glyphicon-edit btn btn-success"></span>
                                                                                                   </a>


                                                                                                   <a title="delete" href="" onclick="return confirm('Are you want to delete this information :press Ok for delete otherwise Cancel')">
                                                                                                       <span class="glyphicon glyphicon-trash btn btn-danger"></span>
                                                                                                   </a></td>

                                                                                   </td>
                                                                                 </tr>
                                                                                 </tbody>
                                      </table>
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