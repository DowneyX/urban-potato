<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/output.css" />
    <title>Document</title>
</head>

<body>
    <div class="flex flex-col h-screen justify-between">
        <?php include("includes/Navbar.php") ?>
        <main class="mb-auto">
            <?php include("includes/AlertMessage.php") ?>
            <?php include("includes/AlertError.php") ?>
            <?php include("includes/AdminFormUpdateCourse.php") ?>
        </main>
        <?php include("includes/Footer.php") ?>
    </div>
</body>

</html>