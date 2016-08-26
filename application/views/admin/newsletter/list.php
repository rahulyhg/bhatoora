    <!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/datatables/dataTables.bootstrap.css">
   <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $pageTitle; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url().'admin/dashboard/'; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $pageTitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
<!--            <div class="box-header">
              <h3 class="box-title" style="float:right"><a href="<?php echo base_url(); ?>admin/category/add" class="btn btn-block btn-primary">Add Category</a></h3>
            </div>-->
              <div>&nbsp;</div>  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    
                <tr>
                    <th style="width:10%">Sno</th>
                    <th style="width:20%">Name</th>
                    <th style="width:20%">Email</th>
                    <th style="width:15%">Subscription Date</th>
                    <th style="width:15%">Unsubscription Date</th>
                    <th style="width:20%">Subscribed</th>
                
                </tr>
                
                </thead>
                <tbody>
                  <?php 
//                  echo "<pre>";
//                  print_r($arrUserList);
//                  exit;
                  
                  if(count($arrSubscribers) > 0 ) {
                        $sno  = 1;
                        foreach($arrSubscribers as $subscriber) { ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $subscriber['customer_name']; ?></td>
                            <td><?php echo $subscriber['email']; ?></td>
                            <td><?php echo $subscriber['subscription_date']; ?></td>
                            <td><?php echo $subscriber['unsubscription_date']; ?></td>
                            <td>
                             
                                <?php if($subscriber['active'] == 'Y') { ?>
                                <a href="<?php echo base_url() .'admin/newsletter/changestatus/' .$subscriber['id'].'/N'; ?>">
                                    <i class="fa"></i> Yes
                                </a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() .'admin/newsletter/changestatus/' .$subscriber['id'].'/Y'; ?>">
                                    <i class="fa"></i> No
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
                    <th style="width:10%">Sno</th>
                    <th style="width:20%">Name</th>
                    <th style="width:20%">Email</th>
                    <th style="width:15%">Subscription Date</th>
                    <th style="width:15%">Unsubscription Date</th>
                    <th style="width:20%">Subscribed</th>
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
