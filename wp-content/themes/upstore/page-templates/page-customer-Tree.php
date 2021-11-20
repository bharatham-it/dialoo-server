<?php
/**
* The template for displaying the login
*
* Template Name: Sponsor Tree Template
*
* @package WordPress
* @subpackage Poultry
* @since Poultry 1.0
*/
?>
<?php
get_header();
$sponsortrees = array(
     array('First Name'=> 'Customer 1',  'Level'=>'1', 'Customer ID'=> '334435435', 'PerPV'=>23, 'CustPV'=>23,'TotalPV'=>23,'Location' =>'Thrissur'),
     array('First Name'=> 'Customer 2',  'Level'=>'1', 'Customer ID'=> '546565467', 'PerPV'=>23, 'CustPV'=>23,'TotalPV'=>23,'Location' =>'Kozhikode'),
     array('First Name'=> 'Customer 3',  'Level'=>'1', 'Customer ID'=> '546676576', 'PerPV'=>23, 'CustPV'=>23,'TotalPV'=>23,'Location' =>'Thrissur'),
     array('First Name'=> 'Customer 4',  'Level'=>'1', 'Customer ID'=> '235354433', 'PerPV'=>23, 'CustPV'=>23,'TotalPV'=>23,'Location' =>'Ernakulam'),
);
$rowno = 1;
?>
<main class="container-fluid">
    <h3>Customers List</h3>
    <table class="table table-stripped">
        <thead class="table-dark text-center">
            <tr class="border-bottom text-center">
                <th scope="col">#</th>
                <?php 
                foreach($sponsortrees[0] as $fieldname => $fieldvalue) :
            ?>
                <th><?php echo sentenceCase($fieldname); ?> </th>
                <?php 
                endforeach;
            ?>
            <th>Actions</th>
            </tr>
        </thead>


        <?php 
        foreach($sponsortrees as $sponsortree) :
        ?>
        <tbody>
            <tr class="border-bottom text-center">
                <th scope="col"><?php echo $rowno; ?></th>
                <?php
                foreach($sponsortree as $fieldname => $fieldvalue) :
                ?>
                <td>
                    <?php 
                    echo ($fieldvalue); 
                    ?>
                </td>
                <?php
                endforeach;
                ?>
                <td>
                <?php
                $args = array('aid' => 'dailyreport-view', 'aname' => 'dailyreport-view', 'alabel' => 'Team', 'label' => '', 'alink' => home_url() . '/sponsor-view/?id=' . $cid,  'required' => '', 'dclass' => ' m-0 p-0 ', 'aclass' => 'btn-sm btn-success');
                echo get_template_part('template-parts/form/link', '', $args);
                ?>
                </td>
            </tr>
        </tbody>
        <?php
        $rowno++; 
        endforeach;
        ?>

    </table>

</main <?php
get_footer();
?>