<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regression</title>
</head>
<body>
    <?php 
        $param = $reg->getParameters();
        echo '<p>'.$param['m'].'</p>';
        echo '<p>'.$reg->getEquation().'</p>';
    ?>
</body>
</html>