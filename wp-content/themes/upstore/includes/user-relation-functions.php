<?php
function add_user_relation($child_id,$parent_id,$level){
    global $wpdb;
   
    $build_custom_table_data_relation = array(
        'child_id' => $child_id,
        'parent_id' =>$parent_id,
        'level_id'=>$level,
        'position_id'=>'S'
    );
   
   
    return $relation = insert_custom_table($wpdb->prefix .'user_relation_child',$build_custom_table_data_relation);
}

function add_parent_user_level_relation($child_id,$parent_id){
   
   
    $get_childs = get_custom_table('us_user_relation_child','child_id='.$parent_id);
    $add_parent = [];
    if(!empty($get_childs ))
    {
     
        foreach($get_childs as $key => $value){
            $level_id = $value->Level_id +1;
            $parent_id = $value->parent_id;
            $add_parent[] = add_user_relation($child_id,$parent_id,$level_id);
        }
    
    }
   
  
    return $add_parent;
  

}



?>