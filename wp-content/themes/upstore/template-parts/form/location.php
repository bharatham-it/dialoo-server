<?php extract($args); ?>
<?php
    $args = array('id' => 'address', 'name' => 'address', 'label' => 'Address', 'value' => $address, 'required' => 'required','class' => 'alpha','datainvalidmessage' => "Please enter only letters");
    echo get_template_part('template-parts/form/text', '', $args);
?>
<?php
    $args = array('id' => 'town_name', 'name' => 'town_name', 'label' => 'Town Name', 'value' =>$town_name, 'required' => 'required','class' => 'alpha','datainvalidmessage' => "Please enter only letters" );
    echo get_template_part('template-parts/form/text', '', $args);
?>
<?php
    $args = array('id' => 'pincode', 'name' => 'pincode', 'label' => 'Pincode', 'value' =>$pincode, 'required' => 'required','class' => 'mask num','datainvalidmessage' => "Please enter only numbers" );
    echo get_template_part('template-parts/form/text', '', $args);
?>
<?php
    $districts = get_child_of('districts', 11, array('fields' => 'id=>name'));
    $args= array('id' => 'district_id','name' => 'district_id', 'label' => 'District', 'required' => 'required', 'items' =>$districts,'sid'=>$district_id, 'default'=> 'Select District' );
    echo get_template_part( 'template-parts/form/select', '', $args);
?>
