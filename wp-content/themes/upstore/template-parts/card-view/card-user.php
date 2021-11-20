<?php
$defargs = array('cid' => '', 'name' => '', 'label' => '', 'required' => '', 'class' => '', 'value' => '');
$args = array_merge($defargs, $args);
extract($args);
$user_add_data = get_custom_single_row($wpdb->prefix.'user_data','ID='.$cid);
$pic_id="";
if(isset($user_add_data->profile_pic))
$pic_id=$user_add_data->profile_pic;
//$profi_pic=get_post($pic_id);
//print_r($profi_pic);
$pic=wp_get_attachment_image_src($pic_id);

if(!$pic==false)
{
$img_url=$pic[0];
}
else
{
  $img_url=get_template_directory_uri().'/assets/img/noProfile.png';
}
$districtlist = get_the_terms($cid, 'district');
/* $districts = join(', ', wp_list_pluck($districtlist, 'name')); */


if (!empty($statuslist)) {
  $status = join(', ', wp_list_pluck($statuslist, 'name'));
}

?>
<div id="f-<?php echo $cid; ?>" name="f-<?php echo $cid; ?>" class="card shadow border-success col-12 col-md-6 col-lg-4 col-sm-12 p-3 my-2">
  <h3 class="card-header bg-transparent border-success"><?php echo $name ?>(<?php echo $cid ?>)</h3>
  <div class="card-body text-success">
    <img src="<?php echo $img_url; ?>"  class="img-thumbnail" name="profile_piccc" width="150px" height="150px">
    <h5 class="card-title"><?php echo $user_add_data->address?></h5>
    <h5 class="card-title"><?php echo $user_add_data->sponser_code ?></h5>
    <p class="card-text">User List</p>
    <div class="row">
      <div class="col-md-6">
       
      <?php
				//	$args = array('sid'=>'','params'=>array());
				//	echo get_template_part('template-parts/custom-form/supervisors-select', '', $args);
					?>
      </div>
      <div class="col-md-6">
        <?php
       // $args = array('aid' => 'user-assign', 'aname' => 'user-assign', 'alabel' => 'Assign', 'label' => '', 'alink' => home_url() . '/users/assign-user/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-success');
      //  echo get_template_part('template-parts/form/link', '', $args);
        ?>
      </div>
    </div>
  </div>
  <div class="card-footer bg-transparent border-success col px-0  text-center">
    <?php
    $args = array('aid' => 'user-view', 'aname' => 'user-view', 'alabel' => 'View', 'label' => '', 'alink' => home_url().'/'.$cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-info');
    echo get_template_part('template-parts/form/link', '', $args);
    ?>
    
    <?php
    //$args = array('aid' => 'user-edit', 'aname' => 'user-edit', 'alabel' => 'Edit', 'label' => '', 'alink' => home_url() . '/users/registration/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-primary');
    //echo get_template_part('template-parts/form/link', '', $args);
    ?>

    <?php
    //$args = array('aid' => 'user-approve', 'aname' => 'user-approve', 'alabel' => 'Approve', 'label' => '', 'alink' => home_url() . '/users/approve-user/?fid=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-success');
    //echo get_template_part('template-parts/form/link', '', $args);
    ?>
   

  </div>
</div>