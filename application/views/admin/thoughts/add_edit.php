

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <?php echo $page_title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Category</a></li>
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
            <?php echo form_open($form_submit_url); ?>
            
              <div class="box-body">
                <div class="form-group">
                <label>Thought</label>
                <?php $data = array(
                    'type'          => 'text',    
                    'name'          => 'thought',
                    'id'            => 'thought',
                    'maxlength'     => '1000',
                    'placeholder'   => 'Thought',    
                    'class'         => 'form-control',
                    'value'         =>  $arrSelectedItemList['thought']
                    );
                    echo form_error('thought');
                    echo form_input($data);
                ?>
        
        
                </div>
                <div class="form-group">
                    <label>Said by</label>
                    
                   <?php $data = array(
                    'type'          => 'text',    
                    'name'          => 'said_by',
                    'id'            => 'said_by',
                    'maxlength'     => '1000',
                    'placeholder'   => 'Said by',    
                    'class'         => 'form-control',
                    'value'         =>  $arrSelectedItemList['said_by']
                    );
                    echo form_error('said_by');
                    echo form_input($data);
                    ?>

                </div>
                  
                  
                <div class="form-group">
                 <label>Order</label>

                <?php $data = array(
                 'type'          => 'text',    
                 'name'          => 'seq_ord',
                 'id'            => 'seq_ord',
                 'maxlength'     => '2',
                 'placeholder'   => 'Order',    
                 'class'         => 'form-control',
                 'value'         =>  $arrSelectedItemList['seq_ord']
                 );
                 echo form_error('seq_order');
                 echo form_input($data);
                 ?>

                </div>
                  
                  
<!--                <div class="form-group">
                    <label>Date:</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="datepicker">
                    </div>
                     /.input group 
                </div>-->
              <!-- /.form group -->
              
              
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <a href="<?php echo base_url(). 'admin/thoughts'; ?>" class="btn btn-default">Back</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                
              </div>
            </form>
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