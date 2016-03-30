<link href="<?=$this->getModuleUrl('static/css/ticker.css') ?>" rel="stylesheet">

<legend><?=$this->getTrans('boxSettings') ?></legend>
<form class="form-horizontal" method="POST" action="">
    <?=$this->getTokenField() ?>
    <div class="form-group">
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
    <div class="form-group">
        <label for="ticker_box_limit" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerBoxLimit') ?>
        </label>
        <div class="col-lg-2 input-group">
            <div class="container">
                <div class="input-group spinner">
                    <input class="form-control"
                           type="text"
                           id="ticker_box_limit"
                           name="ticker_box_limit"
                           min="1"
                           value="<?=$this->get('ticker_box_limit') ?>">
                    <div class="input-group-btn-vertical">
                        <span class="btn btn-default"><i class="fa fa-caret-up"></i></span>
                        <span class="btn btn-default"><i class="fa fa-caret-down"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="ticker_speed" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerSpeed') ?>
        </label>
        <div class="col-lg-2 input-group">
            <div class="container">
                <div class="input-group spinner">
                    <input class="form-control"
                           type="text"
                           id="ticker_speed"
                           name="ticker_speed"
                           min="500"
                           value="<?=$this->get('ticker_speed') ?>">
                    <div class="input-group-btn-vertical">
                        <span class="btn btn-default"><i class="fa fa-caret-up"></i></span>
                        <span class="btn btn-default"><i class="fa fa-caret-down"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="ticker_interval" class="col-lg-2 control-label">
            <?=$this->getTrans('tickerInterval') ?>
        </label>
        <div class="col-lg-2 input-group">
            <div class="container">
                <div class="input-group spinner">
                    <input class="form-control"
                           type="text"
                           id="ticker_interval"
                           name="ticker_interval"
                           min="1000"
                           value="<?=$this->get('ticker_interval') ?>">
                    <div class="input-group-btn-vertical">
                        <span class="btn btn-default"><i class="fa fa-caret-up"></i></span>
                        <span class="btn btn-default"><i class="fa fa-caret-down"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=$this->getSaveBar()?>
</form>

<script language="JavaScript" type="text/javascript">
$(function() {
    $('.spinner .btn:first-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {
            input.val(parseInt(input.val(), 10) + 1);
        } else {
            btn.next("disabled", true);
        }
    });
    $('.spinner .btn:last-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {
            input.val(parseInt(input.val(), 10) - 1);
        } else {
            btn.prev("disabled", true);
        }
    });
})
</script>
