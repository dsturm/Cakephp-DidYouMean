<h3><?php __('Dictionary'); ?></h3>
<ul>
        <li><?php echo $this->Html->link(__('Add word to dictionary', true), array('controller' => 'didyoumean_dictionaries','action' => 'add'));?></li>
        <li><?php echo $this->Html->link(__('Import words to dictionary', true), array('controller' => 'didyoumean_dictionaries','action' => 'import'));?></li>
</ul>