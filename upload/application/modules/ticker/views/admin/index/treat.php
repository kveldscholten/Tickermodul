<legend>
    <?php
    if ($this->get('ticker') != '') {
        echo $this->getTrans('edit');
    } else {
        echo $this->getTrans('add');
    }
    ?>
</legend>

<!-- Fehlerausgabe der Validation -->
<?php if ($this->validation()->hasErrors()): ?>
    <div class="alert alert-danger" role="alert">
        <strong> <?=$this->getTrans('errorsOccured') ?>:</strong>
        <ul>
            <?php foreach ($this->validation()->getErrorMessages() as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<!-- Ende Fehlerausgabe der Validation -->

<form method="POST" class="form-horizontal" action="">
    <?=$this->getTokenField() ?>
    <div class="form-group <?=$this->validation()->hasError('title') ? 'has-error' : '' ?>">
        <label for="title" class="col-lg-2 control-label">
            <?=$this->getTrans('title') ?>
        </label>
        <div class="col-lg-2">
            <input class="form-control"
                   type="text"
                   name="title"
                   id="title"
                   value="<?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getTitle()); } else { echo $this->originalInput('title'); } ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('link') ? 'has-error' : '' ?>">
        <label for="link" class="col-lg-2 control-label">
            <?=$this->getTrans('link') ?>
        </label>
        <div class="col-lg-2">
            <input class="form-control"
                   type="text"
                   name="link"
                   id="link"
                   value="<?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getLink()); } else { echo $this->originalInput('link'); } ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('text') ? 'has-error' : '' ?>">
        <label for="text" class="col-lg-2 control-label">
            <?=$this->getTrans('text') ?>
        </label>
        <div class="col-lg-3">
            <textarea class="form-control"
                   name="text"
                   id="text"
                   rows="2"><?php if ($this->get('ticker') != '') { echo $this->escape($this->get('ticker')->getText()); } else { echo $this->originalInput('text'); } ?></textarea>
        </div>
    </div>

    <?php if ($this->get('ticker') != ''): ?>
        <?=$this->getSaveBar('edit'); ?>
    <?php else: ?>
        <?=$this->getSaveBar('add'); ?>
    <?php endif; ?>
</form>
