  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		  <?php echo $pagetitle; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
       	<div class="col-md-12">
          <div class="box box-warning">
			<?php echo form_open($form_url, 'class="form-group has-feedback" id="usergroups"'); ?>
            <!-- /.box-header -->
            <div class="box-header with-border">
				<div class="col-md-12">
				<?php
					$btn_submit = array(
					        'name'          => 'submit',
					        'id'            => 'btnsave',
					        'value'         => 'Save',
					        'type'          => 'submit',
					        'content'       => ($mode == "add") ? '<i class="fa fa-save" ></i>  Save Data' : '<i class="fa fa-save" ></i> Save Changes',
							'class' 		=> 'btn btn-success pull-right'
					);
				
					$btn_cancel = array(
					        'name'          => 'cancel',
					        'id'            => 'btncancel',
					        'value'         => 'Cancel',
					        'type'          => 'reset',
					        'content'       => ($mode == "add") ? '<i class="fa fa-undo" ></i> Cancel' : '<i class="fa fa-undo" ></i> Cancel Changes',
							'class' 		=> 'btn btn-primary pull-right',
							'style' 		=> 'margin-right: 5px;'
					);
					echo form_button($btn_submit);
					echo form_button($btn_cancel);
	                ?>
				</div>
            </div>
            <div class="box-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Name</label>
                      <?php echo form_input($name); ?>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label>URL</label>
                      <?php echo form_input($url);?>
                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <?php echo form_input($desc); ?>
                    </div>
                    <div class="form-group">
                      <label>Icon</label>
                      <?php echo form_dropdown($menu_icon);?>
                    </div>
                  </div>
				  <div class="col-md-4">
                      <div class="form-group">
                        <label>Parent Item</label>
                        <?php echo form_input($parent); ?>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <?php echo form_input($status); ?>
                      </div>
                      <div class="form-group">
                        <label>Access</label>
                        <?php echo form_input($access); ?>
                      </div>
                      <div class="form-group">
                        <label>Note</label>
                        <?php echo form_input($note); ?>
                      </div>
				  </div>
                </div>
            </div>
			<!-- /.box-body -->
			<?php echo form_close(); ?>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->