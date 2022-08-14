<h2>Hello World</h2>


<ul>
    <?php foreach ($user as $item): ?>
    <li><?= $item->name ?></li>
    <?php endforeach; ?>
</ul>