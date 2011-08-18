<div class="didyoumeanDictionaries form">
<?php echo $this->Form->create('DidyoumeanDictionary');?>
	<fieldset>
 		<legend><?php __('Import Didyoumean Dictionary'); ?></legend>
	<?php
		echo $this->Form->textarea('input');
                echo $this->Form->input('seperator',array('options' => array("\n" => 'Line break (Enter)',';' => 'Semicolon (;)',',' => 'Comma (,)', '.' => 'Period (.)', ' ' => 'Space ( )'), 'selected' => "\n"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>