

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $page_title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?php echo $this->session->flashdata('error_message'); ?>
                    <?php echo $this->session->flashdata('success_message'); ?>
                </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart($form_submit_url); ?>
            
              <div class="box-body">
                <div class="form-group">
                <label>Title</label>
                <?php $data = array(
                    'type'          => 'text',    
                    'name'          => 'title',
                    'id'            => 'title',
                    'maxlength'     => '200',
                    'placeholder'   => 'Title',    
                    'class'         => 'form-control',
                    'value'         =>  $arrSelectedItemList['title']
                    );
                    echo form_error('title');
                    echo form_input($data);
                ?>
        
        
                </div>
                <div class="form-group">
                    <label>Banner</label>
                    
                   <?php 
                    echo form_error('banner');
                    echo form_upload(array('name' =>'banner','id'=>'banner')); ?>
                    
                    <input type="hidden" name="hidden_banner_name" id="hidden_banner_name" value="<?php echo $arrSelectedItemList['banner_image']; ?>">
                    
                    <?php
                    if(!empty($arrSelectedItemList['banner_image'])) { ?>
                    <br><br>
                    <img src="<?php echo base_url(); ?>/uploads/banners/<?php echo $arrSelectedItemList['banner_image']; ?>"
                         alt="<?php echo $arrSelectedItemList['title']; ?>" width="200" height="75">
                        
                    <?php }
                    ?>
                    
                </div>
                  
                  
                  
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <a href="<?php echo $back_url; ?>" class="btn btn-default">Back</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                
              </div>
          
          </div>
          <!-- /.box -->

        

        </div>
        <!--/.col (left) -->
       
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
<!--    <script>
        $(function () {
         //Date picker
        $('#datepicker').datepicker({
          autoclose: true
        });
    });
    </script>-->