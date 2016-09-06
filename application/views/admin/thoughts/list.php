    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/datatables/dataTables.bootstrap.css">
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Categories
        <small>& Sub categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard/'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Categories</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header">
              <h3 class="box-title" style="float:right"><a href="<?php echo base_url(); ?>admin/category/add" class="btn btn-block btn-primary">Add Category</a></h3>
            </div>
              <div>&nbsp;</div>  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    
                <tr>
                    <th style="width:10%">Sno</th>
                    <th style="width:35%">Category</th>
                    <th style="width:35%">Parent Category</th>
                    <th style="width:20%">Action</th>
                </tr>
                
                </thead>
                <tbody>
                  <?php 
//                  echo "<pre>";
//                  print_r($arrCategoryList);
//                  exit;
                  
                  if(count($arrCategoryList) > 0 ) {
                        $sno  = 1;
                        foreach($arrCategoryList as $category) { ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $category['category_name']; ?></td>
                            <td><?php echo $category['parent_category_name']; ?></td>
                            <td>
                                <a href="<?php echo base_url() . 'admin/category/edit/id/' . $category['id']; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                              
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                
                                <?php if($category['status'] == 'A') { ?>
                                <a href="<?php echo base_url() .'admin/category/changestatus/' .$category['id'].'/I'; ?>">
                                    <i class="fa"></i> Active
                                </a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() .'admin/category/changestatus/' .$category['id'].'/A'; ?>">
                                    <i class="fa"></i> Inactive
                                </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                      
                      }
                  }  
                  ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Sno</th>
                    <th>Category</th>
                    <th>Parent Category</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
    
    <!-- /.content -->
    
    <!-- DataTables -->
<script src="<?php echo base_url(); ?>/assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
 <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>