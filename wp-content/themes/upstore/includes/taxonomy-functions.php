<?php
function get_child_of($taxonomy, $parentid, $addl = array())
{
    $args = array(
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
        'child_of' => $parentid, 
    );
    if($addl) {
        $args = array_merge($args, $addl);
    }
    return get_terms($args); 
}
function get_parent_of($taxonomy,$parentid,$addl = array()){
    $args = array(
        'taxonomy' => $taxonomy,
        'parent' => $parentid,
        'hide_empty' => false
    );
    if($addl) {
        $args = array_merge($args, $addl);
    }

   return get_terms($args);
}

function get_taxonomy_name_by_post($postid, $taxonomy, $field)
{
    $list = get_the_terms( $postid, $taxonomy);
    return join(', ', wp_list_pluck($list, $field));
}

function sentenceCase($string) { 
    $sentences = preg_split('/([.?!]+)/', $string, -1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE); 
    $newString = ''; 
    $sentences =str_replace('_',' ',$sentences);
    foreach ($sentences as $key => $sentence) { 
        $newString .= ($key & 1) == 0? 
            ucfirst(strtolower(trim($sentence))) : 
            $sentence.' '; 
    } 
    return trim($newString); 
}
function get_taxonomy_name($id,$name){
    $term = get_term_by('id', $id,$name ); 
    return $term->name;
   }


   function state_by_district($district_id)
{
    $term = get_term($district_id, 'districts');
    $state_id = $term->parent;
    return $state_id;
}
function get_country_id($district_id)
{
    $term = get_term($district_id, 'districts');
    $state_id = $term->parent;
    $term_state = get_term($state_id, 'districts');

    return $term_state->parent;
}

function add_state_and_district()
{
    $state_data  = get_custom_table("states", "1=1");
   
    foreach ($state_data as $key => $value) {

        $district_custom  = get_custom_table("districts", "state_id = $value->id");
        $state_custom  = wp_insert_term($value->name, 'districts',array('parent'=>777));
        foreach ($district_custom as $key => $value) {
            $district_id = wp_insert_term($value->name, 'districts', array('parent' => $state_custom['term_id']));
        }

        
    }
}
   

function delete_all_terms()
{

    $term_data = get_parent_of('districts', 0, array('fields' => 'id=>name'));
    print_r($term_data);


    foreach ($term_data as $key => $value) {

        $child_data = get_child_of('districts', $value->id, array('fields' => 'id=>name'));
        print_r($child_data);
      
        $id = wp_delete_term($key, 'districts');
        foreach($child_data as $key => $value)
        {
            $id = wp_delete_term($key, 'districts');
            
        }
      
      
    }
}




?>