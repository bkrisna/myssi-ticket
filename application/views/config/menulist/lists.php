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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a class="btn btn-primary btn-sm" href="<?php echo base_url('config/menulist/create');?>"><i class="fa fa-plus"></i> Add Menu</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<?php
					if ($menu_breadcrumb != null ) 
					{
						$html_out = '<ol class="breadcrumb">';
						
						foreach ($menu_breadcrumb as $menu_item)
						{
							if ($menu_item['is_active'] == 1) 
							{
								$html_out .= '<li class="active"><i class="fa '.$menu_item['menu_icon'].'"></i> '.$menu_item['name'].'</li>';
							}
							else
							{
								$html_out .= '<li><a href="'.site_url('config/menulist/lists/'.$menu_item['id']).'"><i class="fa '.$menu_item['menu_icon'].'"></i> '.$menu_item['name'].'</a></li>';
							}
							
						}
						
						$html_out .= '</ol>';
						echo $html_out;
					}
				?>
              <table id="menulist" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="30">#</th>
                  <th>Menu Name</th>
                  <th>URL</th>
                  <th width="50">Sort</th>
				  <th width="200">Menu Key</th>
				  <th width="200">Child Menu Count</th>
				  <th width="100">Menu Icon</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($menus as $menu)
                  {
                    $out = '<tr>';
                    $out .= '<td>'.$menu['id'].'</td>';
               	 	$out .= '<td>';
					if ($menu['child_count'] > 0) 
					{
						$out .= anchor(site_url(array($module_key, $menu['id'])), $menu['name'] );
					}
					else
					{	
						$out .= $menu['name'];
					}
					$out .='</td>';
					$out .= '<td>'.$menu['url'].'</td>';
					$out .= '<td>'.$menu['sort'].'</td>';
					$out .= '<td>'.$menu['module_name'].'</td>';
					$out .= '<td>'.$menu['child_count'].'</td>';
					$out .= '<td align="center"><i class="fa '.$menu['menu_icon'].'"></i></td>';
                    $out .= '<td><a class="btn btn-default btn-xs '.$color.'" href="'.base_url('usergroups/edit/'.$menu['id']).'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;<a class="btn btn-default btn-xs '.$color.'" href="'.base_url('usergroups/delete/'.$menu['id']).'"><i class="fa fa-trash-o"></i></a></td>';
                    $out .= '</tr>';

                    echo $out;
                  }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->