<div class="didyoumeanSettings form">
    <?php
    echo $this->Form->create('DidyoumeanSetting', array( 'url' => array('plugin' => 'didyoumean', 'controller' => 'didyoumean', 'action' => 'edit',  $this->data['DidyoumeanSetting']['id'])));
    echo $this->Form->input('value', array('label' => "Value (Type: " . $this->data['DidyoumeanSetting']['type'] . ")"));
    echo $this->Form->hidden('type');
    echo $this->Form->hidden('id');
    echo $this->Form->end(__('Submit', true)); ?>
</div>

