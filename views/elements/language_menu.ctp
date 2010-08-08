<h3><?php __('Language'); ?></h3>
<ul>
        <li><?php echo $this->Html->link(__('Add language', true), array('controller' => 'didyoumean_languages','action' => 'add'));?></li>
        <li><?php echo $this->Html->link(__('List languages', true), array('controller' => 'didyoumean_languages','action' => 'index'));?></li>
</ul>