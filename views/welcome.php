<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to MVC Framework</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('assets/style.css') ?>">
</head>
<body>

    <div class="welcome-box text-center">
        <h1>Welcome To MVC Framework</h1>
        <p class="font-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, odit?</p>
        <!--<p>Developer By: <a href="<?/*= $link */?>">Hm Shahed</a></p>-->

        <?= dd($_SERVER) ?>
    </div>
</body>
</html>