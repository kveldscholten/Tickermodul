<?php $ticker_dateNow = new \Ilch\Date(); ?>

<link rel="stylesheet" href="<?=$this->getBoxUrl('static/css/ticker.css') ?>">

<div class="row">
    <div class="col-lg-12 ticker-box">
        <div id="ticker-content">
            <a href="<?=$this->getUrl('ticker/index/index/') ?>" alt="<?=$this->getTrans('menuTicker') ?>">
                <div class="ticker-header"><?=$this->getTrans('menuTicker') ?></div>
            </a>
            <div class="ticker-body">
                <ul>
                    <?php if ($this->get('ticker') != ''): ?>
                        <?php foreach ($this->get('ticker') as $ticker): ?>
                            <?php $ticker_date = new \Ilch\Date($ticker->getDateTime()); ?>
                            <li>
                                <table>
                                    <tr>
                                        <td class="time" rowspan="2">
                                            <?php if ($ticker_date->format('d.m.Y') != $ticker_dateNow->format('d.m.Y')) {
                                                echo '<b>'.$ticker_date->format('H:i').'<br />'.$ticker_date->format('d.m').'</b>';
                                            } else {
                                                echo '<b>'.$ticker_date->format('H:i').'</b>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($ticker->getLink() != '') {
                                                echo '<a href="'.$ticker->getLink().'">'.$ticker->getTitle().'</a>';
                                            } else {
                                                echo $ticker->getTitle();
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?=$ticker->getText() ?></td>
                                    </tr>
                                </table>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li style="padding-bottom: 17px;"><?=$this->getTrans('noTicker') ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="<?=$this->getBoxUrl('static/js/jquery.easy-ticker.js') ?>"></script>
<script type="text/javascript">
$('.ticker-body').easyTicker({
    direction: '<?=$this->get('tickerDirection') ?>',
    speed: <?=$this->get('tickerSpeed') ?>,
    interval: <?=$this->get('tickerInterval') ?>,
    visible: <?=$this->get('tickerLimit') ?>,
    mousePause: 1
});
</script>
