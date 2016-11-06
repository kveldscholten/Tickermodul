<link href="<?=$this->getModuleUrl('static/css/ticker.css') ?>" rel="stylesheet">

<legend><?=$this->getTrans('settings') ?></legend>

<!-- Fehlerausgabe der Validation -->
<?php if ($this->validation()->hasErrors()): ?>
    <div class="alert alert-danger" role="alert">
        <strong> <?=$this->getTrans('errorsOccured') ?>:</strong>
        <ul>
            <?php foreach ($this->validation()->getErrorMessages() as $error): ?>
                <li><?=$error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<!-- Ende Fehlerausgabe der Validation -->

<form class="form-horizontal" method="POST" action="">
    <?=$this->getTokenField() ?>
    <div class="form-group <?=$this->validation()->hasError('ticker_limit') ? 'has-error' : '' ?>">
        <label for="ticker_box_limit" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerLimit') ?>
        </label>
        <div class="col-lg-1">
            <input class="form-control"
                   type="number"
                   id="ticker_limit"
                   name="ticker_limit"
                   min="1"
                   value="<?=$this->get('ticker_limit') ?>">
        </div>
    </div>

    <legend><?=$this->getTrans('boxSettings') ?></legend>
    <div class="form-group <?=$this->validation()->hasError('ticker_direction') ? 'has-error' : '' ?>">
        <label for="ticker_direction" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerDirection') ?>
        </label>
        <div class="col-lg-2">
            <div class="flipswitch">  
                <input type="radio" class="flipswitch-input" name="ticker_direction" value="up" id="ticker-up" <?php if ($this->get('ticker_direction') == 'up') { echo 'checked="checked"'; } ?> />  
                <label for="ticker-up" class="flipswitch-label flipswitch-label-on"><?=$this->getTrans('up') ?></label>  
                <input type="radio" class="flipswitch-input" name="ticker_direction" value="down" id="ticker-down" <?php if ($this->get('ticker_direction') == 'down') { echo 'checked="checked"'; } ?> />  
                <label for="ticker-down" class="flipswitch-label flipswitch-label-off"><?=$this->getTrans('down') ?></label>  
                <span class="flipswitch-selection"></span>  
            </div>
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('ticker_box_limit') ? 'has-error' : '' ?>">
        <label for="ticker_box_limit" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerBoxLimit') ?>
        </label>
        <div class="col-lg-1">
            <input class="form-control"
                   type="number"
                   id="ticker_box_limit"
                   name="ticker_box_limit"
                   min="1"
                   value="<?=$this->get('ticker_box_limit') ?>">
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('ticker_speed') ? 'has-error' : '' ?>">
        <label for="ticker_speed" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerSpeed') ?>
        </label>
        <div class="col-lg-1">
            <input class="form-control"
                   type="number"
                   id="ticker_speed"
                   name="ticker_speed"
                   min="500"
                   value="<?=$this->get('ticker_speed') ?>">
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('ticker_interval') ? 'has-error' : '' ?>">
        <label for="ticker_interval" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerInterval') ?>
        </label>
        <div class="col-lg-1">
            <input class="form-control"
                   type="number"
                   id="ticker_interval"
                   name="ticker_interval"
                   min="1000"
                   value="<?=$this->get('ticker_interval') ?>">
        </div>
    </div>
    <?=$this->getSaveBar()?>
</form>
