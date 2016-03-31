<?php $ticker_dateNow = new \Ilch\Date(); ?>

<link rel="stylesheet" href="<?=$this->getModuleUrl('static/css/ticker.css') ?>">

<legend><?=$this->getTrans('menuTicker') ?></legend>
<div class="row">
    <div class="col-lg-12">
        <?php if ($this->get('ticker') != ''): ?>
            <div id="ticker-content">
                <div class="ticker-body">
                    <ul>
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
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <?=$this->getTrans('noTicker') ?>
        <?php endif; ?>
    </div>
</div>
