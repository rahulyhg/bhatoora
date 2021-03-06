
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
            <?php 
            echo form_open($form_submit_url); 
            ?>
              <div class="box-body">
                <div class="form-group">
                    
                <label>Category</label>
                <?php $data = array(
                    'type'          => 'text',    
                    'name'          => 'category_name',
                    'id'            => 'category_name',
                    'maxlength'     => '100',
                    'placeholder'   => 'Category Name',    
                    'class'         => 'form-control',
                    'value'         =>  $category_name
                    );
                    echo form_error('category_name');
                    echo form_input($data);
                ?>
        
        
                </div>
                <div class="form-group">
                    <label>Parent Category</label>
                    
                    <?php 
                    $arrCategoryList[0] = '--Select Parent Category--';
                    echo form_dropdown('parent_catgory', $arrCategoryList, $parent_category,'class="form-control"'); ?>

                </div>
                  
                <div class="form-group">
                    <label>Order</label>
                    
                    <?php $data = array(
                    'type'          => 'text',    
                    'name'          => 'display_order',
                    'id'            => 'display_order',
                    'maxlength'     => '2',
                    'placeholder'   => 'Display Order',    
                    'class'         => 'form-control',
                    'value'         =>  $display_order
                    );
                    echo form_error('display_order');
                    echo form_input($data);
                ?>

                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <a href="<?php echo base_url(). 'admin/category'; ?>" class="btn btn-default">Back</a>
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
  </div>
 