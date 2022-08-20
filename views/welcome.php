<!--<!doctype html>
<html lang="en" class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to MVC Framework</title>
    <link rel="stylesheet" href="<? /*= asserts('assets/style.css') */ ?>">
</head>
<body class="body">
    <div class="welcome-body">
        <div class="welcome-box text-center">
            <h1 class="text-gray2">Welcome To MVC Framework</h1>
            <p class="font-bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, odit?</p>
            <p>Developed By: <a href="https://www.facebook.com/nfs.hmshahed" class="font-bold" target="_blank">Hm Shahed</a></p>
        </div>
    </div>
</body>
</html>-->
<ul>
    <?php foreach ($users as $user): ?>
        <li><?= $user->name ?></li>
    <?php endforeach; ?>
</ul>
<?php dd($_SESSION['flash_messages']) ?>
<?php if (\App\Config\Session::has('test')): ?>
<?= \App\Config\Session::get('test') ?>
<?php endif;?>