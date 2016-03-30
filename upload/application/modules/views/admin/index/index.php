<?php if ($this->get('ticker') != ''): ?>
    <form class="form-horizontal" method="POST" action="">
        <?=$this->getTokenField() ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <colgroup>
                    <col class="icon_width">
                    <col class="icon_width">
                    <col class="icon_width">
                    <col class="col-lg-2">
                    <col />
                </colgroup>
                <thead>
                    <tr>
                        <th><?=$this->getCheckAllCheckbox('check_entries') ?></th>
                        <th></th>
                        <th></th>
                        <th><?=$this->getTrans('title') ?></th>
                        <th><?=$this->getTrans('text') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->get('ticker') as $ticker): ?>
                        <tr>
                            <td><input value="<?=$ticker->getId() ?>" type="checkbox" name="check_entries[]" /></td>
                            <td><?=$this->getEditIcon(array('action' => 'treat', 'id' => $ticker->getId())) ?></td>
                            <td><?=$this->getDeleteIcon(array('action' => 'del', 'id' => $ticker->getId())) ?></td>
                            <td><?=$ticker->getTitle() ?></td>
                            <td><?=$ticker->getText() ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?=$this->getListBar(array('delete' => 'delete')) ?>
    </form>
<?php else: ?>
    <?=$this->getTrans('noTicker') ?>
<?php endif; ?>
