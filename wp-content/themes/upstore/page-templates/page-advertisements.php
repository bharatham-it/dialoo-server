<?php

/**
 * The template for displaying the Farms
 *
 * Template Name: Advertisements-List Template
 *
 * @package WordPress
 * @subpackage Poultry
 * @since Poultry 1.0
 */
?>

<?php
authorization_check( true );
authorization_user( array() );
get_header();
?>
<?php
$args = array(
  'numberposts' => 10,
  'post_type'   => 'advertisement',
  'orderby'          => 'date',
  'order'            => 'DESC'
);

$ads = get_posts($args);


?>
<div class="container-fluid">
    <div class="row">
    <?php
    if($ads)
    {
      foreach ($ads as $ad) :
        $id=$ad->ID;
        $title=$ad->post_title;
        $content=$ad->post_content;
        ?>
        <div id="f-<?php echo $id; ?>" name="f-<?php echo $id; ?>" class="card shadow border-success col-12 col-md-6 col-lg-4 col-sm-12 p-3 my-2">
        <h3 class="card-header bg-transparent border-success"><?php echo $title ?>(<?php echo $id ?>)</h3>
        <div class="card-body text-success">
        <h5 class="card-title"><img src="<?php echo get_the_post_thumbnail_url($id,'post-thumbnail');?>" width="150" height="100"></h5>
          <p class="card-text"><?php echo $content?></p>
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
      <?php
      endforeach; 
    }
    else
    {
      echo"No Advertisements Available";
    }
    ?>
    </div>
</div>


<?php
  get_footer();
?>