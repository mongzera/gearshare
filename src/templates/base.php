<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel='stylesheet' href="/static/css/global.css"/>
    <link rel='stylesheet' href="/static/css/header.css"/>

    <?php 
        if(isset($content['css'])) {
            foreach($content['css'] as $links){
                echo "<link rel='stylesheet' href='{$links}'/>";
            }
        };
        
    ?>

<?php 
        if(isset($content['js'])) {
            foreach($content['js'] as $script){
                echo "<script src='$script'></script>";
            }
        };
        
    ?>
</head>
<body>
    <div class="container">
        <?php 
            if(isset($content['header'])) include $content['header'];
            if(isset($content['body'])) include $content['body'];
        ?>
    </div>
</body>
</html>