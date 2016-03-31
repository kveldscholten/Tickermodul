<form method="POST" class="form-horizontal" action="">
    <?=$this->getTokenField() ?>
    <div class="form-group">
        <label for="title" class="col-lg-2 control-label">
            <?=$this->getTrans('title') ?>
        </label>
        <div class="col-lg-2">
            <input class="form-control"
                   type="text"
                   name="title"
                   id="title"
                   value="<?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getTitle()); } ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="link" class="col-lg-2 control-label">
            <?=$this->getTrans('link') ?>
        </label>
        <div class="col-lg-2">
            <input class="form-control"
                   type="text"
                   name="link"
                   id="link"
                   value="<?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getLink()); } ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="text" class="col-lg-2 control-label">
            <?=$this->getTrans('text') ?>:
        </label>
        <div class="col-lg-3">
            <textarea class="form-control"
                   name="text"
                   id="text"
                   rows="2"><?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getText()); } ?></textarea>
        </div>
    </div>

    <?php if ($this->get('ticker') != ''): ?>
        <?=$this->getSaveBar('edit'); ?>
    <?php else: ?>
        <?=$this->getSaveBar('add'); ?>
    <?php endif; ?>
</form>
