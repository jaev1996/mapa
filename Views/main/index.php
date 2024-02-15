<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <title>Main</title>
    <style type="text/css">
        .bg{
            background-image: url("<?php echo constant('URL'); ?>public/images/mapafondo.jpg");
      		
      		background-size: 50%;
            width: 100%;
            
      		opacity: 1;
        }
    </style>
</head>
<body class="bg">
    <?php require_once 'Views/header.php'; ?><br>
    <h1 class="text-center display-1 text-white m-4"></h1>
    
    
    

    <?php require_once 'Views/footer.php'; ?>
</body>
</html>