<?php
$defargs= array('cid' => '','name' => '', 'label' => '', 'class' => '', 'value' => ''  );
$args = array_merge($defargs, $args);
extract($args);
/*$fields['farm'] = get_the_title($fields['farm_id']);
$fields['batch'] = get_the_title($fields['batch_id']);
$keys = array('created_on','created_by','approved_by','approved_on','farm_id','batch_id');
$removekeys = array_fill_keys($keys, '');
$fields = array_diff_key($fields, $removekeys); */
// ksort($fields);
    /* $fields['district_id']= get_districts($cid);
    $fields['farmer_id'] = get_display_name($fields['farmer_id']);
    $fields['integrator_id'] = get_display_name($fields['integrator_id']); */
  
?>
<div id="f-<?php echo $id; ?>" name="f-<?php echo $id; ?>" class="card card-profile">
    <div class="card-body">
        <?php 
        foreach($fields as $fieldname => $fieldvalue) :
        ?>
        <div class="row shadow rounded py-3 my-1 border-bottom border-success">
                <div class="col-4 border-end">
                    <?php
                    echo  sentenceCase($fieldname);
                  ?>
                </div>
                <div class="col-8">
                    <?php echo $fieldvalue ?>
                </div>
        </div>
        <?php 
        endforeach;
        ?>
         </div>
<div class="card-footer bg-transparent border-success col px-0 text-center">
  <?php
            // $args = array('aid' => 'farm-view', 'aname' => 'farm-view', 'alabel' => 'View', 'label' => '', 'alink' => get_permalink($cid),  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass'=> 'btn-sm btn-info');
            // echo get_template_part('template-parts/form/link', '', $args);
            ?>
                <?php
            $args = array('aid' => 'farm-edit', 'aname' => 'farm-edit', 'alabel' => 'Edit', 'label' => '', 'alink' => home_url().'/batches/batch-request/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass'=> 'btn-sm btn-primary');
            echo get_template_part('template-parts/form/link', '', $args);
            ?>
                <?php
            $args = array('aid' => 'farm-delete', 'aname' => 'farm-delete', 'alabel' => 'Del', 'label' => '', 'alink' => home_url().'/batches/batch-request/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass'=> 'btn-sm btn-danger');
            echo get_template_part('template-parts/form/link', '', $args);
            ?>
                <?php
            $args = array('aid' => 'farm-approve', 'aname' => 'farm-approve', 'alabel' => 'Approve', 'label' => '', 'alink' => home_url().'/batches/batch-request/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass'=> 'btn-sm btn-success');
            echo get_template_part('template-parts/form/link', '', $args);
            ?>
  </div>
   
</div>