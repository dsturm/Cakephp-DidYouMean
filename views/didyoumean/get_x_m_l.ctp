<?php
    echo $xml->header();
    //pr($output);    
    $info = array('type','count','search_count','percentage','search_string','search_id','suggestion_string','suggestion_id','deviation','max_deviation','related');
    foreach($output as $key=>$value){
        echo "<result>";
        foreach ($info as $i){
            
            if (isset($value[$i])){
                echo $xml->elem($i,null,$value[$i]). "<br />";
            }
            
        }
        echo "</result>";
        
    }
    //echo $xml->serialize($output);
?>