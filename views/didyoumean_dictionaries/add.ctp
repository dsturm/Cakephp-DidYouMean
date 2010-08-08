<div class="didyoumeanDictionaries form">
<?php echo $this->Form->create('DidyoumeanDictionary');?>
	<fieldset>
 		<legend><?php __('Add Didyoumean Dictionary'); ?></legend>
	<?php
		echo $this->Form->input('word');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
    <?php echo $this->element('menu'); ?>
    <?php echo $this->element('dictionary_menu'); ?>
</div>