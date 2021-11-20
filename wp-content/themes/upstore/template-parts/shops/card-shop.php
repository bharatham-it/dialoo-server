<?php
$defargs = array('cid' => '', 'name' => '', 'label' => '', 'required' => '','type'=>'', 'class' => '', 'value' => '');
$args = array_merge($defargs, $args);
extract($args);
if($type=='shop')
{
$table='shops';
$edit_url=home_url() . '/shops/add-shop/?id=' . $cid;
$id='shop_id';
}
else if($type=='service')
{
  $table='services';
  $edit_url=home_url() . '/services/add-service/?id=' . $cid;
  $id='service_id';
}
$tbl_add_data = get_custom_single_row($wpdb->prefix.$table,$id.'='.$cid);

$districtlist = get_the_terms($cid, 'district');
/* $districts = join(', ', wp_list_pluck($districtlist, 'name')); */


if (!empty($statuslist)) {
  $status = join(', ', wp_list_pluck($statuslist, 'name'));
}

?>
<div id="f-<?php echo $cid; ?>" name="f-<?php echo $cid; ?>" class="card shadow border-success col-12 col-md-6 col-lg-4 col-sm-12 p-3 my-2">
  <h3 class="card-header bg-transparent border-success"><?php echo $name ?>(<?php echo $cid ?>)</h3>
  <div class="card-body text-success">
  <h5 class="card-title"><img src="<?php echo get_the_post_thumbnail_url($cid,'post-thumbnail');?>" width="150" height="100"></h5>
    <h5 class="card-title"><?php echo $tbl_add_data->address?></h5>
    <h5 class="card-title"><?php echo /*$shop_add_data->sponser_code*/''; ?></h5>
    <p class="card-text">User List</p>
    <div class="row">
      <div class="col-md-6">
       
      </div>
      <div class="col-md-6">
   
      </div>
    </div>
  </div>
  <div class="card-footer bg-transparent border-success col px-0  text-center">
    <?php
    $args = array('aid' => 'shop-view', 'aname' => 'shop-view', 'alabel' => 'View', 'label' => '', 'alink' =>  get_permalink($cid),  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-info');
    echo get_template_part('template-parts/form/link', '', $args);
    ?>
    
    <?php
    $args = array('aid' => 'edit', 'aname' => 'edit', 'alabel' => 'Edit', 'label' => '', 'alink' =>$edit_url,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-primary');
    echo get_template_part('template-parts/form/link', '', $args);
    ?>

    <?php
    $args = array('aid' => 'approve', 'aname' => 'approve', 'alabel' => 'Approve', 'label' => '', 'alink' => home_url() . '/shops/approve-shop/?fid=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-success');
    echo get_template_part('template-parts/form/link', '', $args);
    ?>
    <?php
    $args = array('aid' => $type.'-delete_'.$cid, 'aname' => 'shop-delete', 'alabel' => 'Delete', 'label' => '', 'alink' => '#',  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-danger shopdel');
    echo get_template_part('template-parts/form/link', '', $args);
    ?>
    <?php
		$args = array('id' => 'typename_'.$cid, 'name' => 'shop_name', 'value' => $name);
		echo get_template_part('template-parts/form/hidden', '', $args);
		?>
     <?php
		$args = array('id' => 'type_'.$cid, 'name' => 'type', 'value' => $type);
		echo get_template_part('template-parts/form/hidden', '', $args);
		?>
   

  </div>
</div>