<nav>
    <ul>
        <li><a href="<?=base_url()?>" >الرئيسية</a></li>
        <?php if($MAINMENU): ?>
            <?php foreach ($MAINMENU as $value): ?>
                <li><?=$value?></li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</nav>