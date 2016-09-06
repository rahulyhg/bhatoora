    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/admin/plugins/datatables/dataTables.bootstrap.css">
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          <?php echo $pageTitle; ?>
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
            <div class="box-header">
              <h3 class="box-title" style="float:right"><a href="<?php echo base_url(); ?>admin/thoughts/add" class="btn btn-block btn-primary"><?php echo $this->lang->line('add_new_button_text'); ?></a></h3>
            </div>
              <div>&nbsp;</div>  
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    
                <tr>
                    <th style="width:10%">Sno</th>
                    <th style="width:30%">Thought</th>
                    <th style="width:30%">Said by</th>
                    <th style="width:10%">Order</th>
                    <th style="width:20%">Action</th>
                </tr>
                
                </thead>
                <tbody>
                  <?php 
//                  echo "<pre>";
//                  print_r($arrCategoryList);
//                  exit;
                  
                  if(count($arrListData) > 0 ) {
                        $sno  = 1;
                        foreach($arrListData as $row) { ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $row['thought']; ?></td>
                            <td><?php echo $row['said_by']; ?></td>
                            <td><?php echo $row['seq_ord']; ?></td>
                            <td>
                                <a href="<?php echo base_url() . 'admin/thoughts/edit/id/' . $row['id']; ?>">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                              
                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                
                                <?php if($row['status'] == 'A') { ?>
                                <a href="<?php echo base_url() .'admin/thoughts/changestatus/' .$row['id'].'/I'; ?>">
                                    <i class="fa"></i> Active
                                </a>
                                <?php } else { ?>
                                <a href="<?php echo base_url() .'admin/thoughts/changestatus/' .$row['id'].'/A'; ?>">
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
                    <th style="width:10%">Sno</th>
                    <th style="width:30%">Thought</th>
                    <th style="width:30%">Said by</th>
                    <th style="width:10%">Order</th>
                    <th style="width:20%">Action</th>
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