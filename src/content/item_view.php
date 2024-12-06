<?php

    if(!isset($itemId)) redirect("/");
    if($item === null) echo "Item cannot be found!";

?>

<div class="content-container flex justify-left">
    <h5 class="thin"><span><a href="#" class='no-decoration'>Search</a></span> > <span> <a href="#" class='no-decoration' ><?php echo $item[0]['name']?></a></span></h5>
    <div class="left">
        
    </div>
    <div class="right">
        
    </div>
</div>