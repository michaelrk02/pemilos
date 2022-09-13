<div style="display: flex; flex-direction: row; flex-wrap: wrap">
    <?php foreach ($tokens as $token): ?>
        <div style="flex: 0 0 192px; height: 96px">
            <div style="display: flex; justify-content: center; align-items: center; height: 100%; border: 1px solid black; background-image: url(<?php echo base_url('public/img/logo-mpk.png'); ?>); background-repeat: no-repeat; background-position: center; background-size: contain">
                <div style="border: 2px solid black; background-color: white; font-family: monospace; padding: 4px">
                    <?php if ($token['vote_id'] == 0): ?>
                        <b><?php echo $token['token']; ?></b>
                    <?php else: ?>
                        <b style="color: red; text-decoration: line-through"><?php echo $token['token']; ?></b>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
