<div class="didyoumeanDictionaries form">
<?php echo $this->Form->create('DidyoumeanDictionary');?>
	<fieldset>
 		<legend><?php __('Import Didyoumean Dictionary'); ?></legend>
	<?php
		echo $this->Form->textarea('input');
                echo $this->Form->input('seperator',array('options' => array(';' => 'Semicolon (;)',',' => 'Comma (,)', '.' => 'Period (.)', ' ' => 'Space ( )'), 'selected' => ';'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
    <?php echo $this->element('menu'); ?>
    <?php echo $this->element('dictionary_menu'); ?>
</div>