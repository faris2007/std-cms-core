<!-- slider -->
    <div class="slider-wrapper">
        <?php if($SLIDERS): ?>
            <div id="slider" class="nivoSlider">
                <?php foreach ($SLIDERS as $row): ?>
                    <img src="<?=$row->picture?>" width="383" height="198" alt="<?=$row->slider_name?>" title="#slid<?=$row->id?>"/>
                <?php endforeach; ?>
            </div>
            <?php foreach ($SLIDERS as $row): ?>
                <div id="slid<?=$row->id?>" class="nivo-html-caption">
                    <strong><?=$row->desc?> <a href="<?=$row->url?>">الرابط</a>.
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<!-- end of slider -->
