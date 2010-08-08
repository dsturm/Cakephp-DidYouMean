<h3><?php __('Menu'); ?></h3>
<ul>
        <li><?php echo $this->Html->link(__('Dictionary', true), array('controller' => 'didyoumean_dictionaries','action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Searches', true), array('controller' => 'didyoumean_searches','action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('Languages', true), array('controller' => 'didyoumean_languages', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Settings', true), array('controller' => 'didyoumean_dictionaries', 'action' => 'add')); ?> </li>
</ul>