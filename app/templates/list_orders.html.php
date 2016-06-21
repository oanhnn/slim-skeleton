<ul>
<?php foreach ($orders as $order) : ?>
    <li><?= $order->id ?>|<?= $order->email ?>|<?= $order->song ?>|<?= $order->createdAt->format('c') ?></li>
<?php endforeach; ?>
</ul>