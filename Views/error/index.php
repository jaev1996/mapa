<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
</head>
<body>
    <?php require_once 'Views/header.php'; ?>

    <h1 class="text-danger text-center display-1"><?php echo $this->mensaje; ?></h1>

    <?php require_once 'Views/footer.php'; ?>

</body>
</html>