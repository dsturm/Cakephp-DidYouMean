<div class="didyoumeanLanguages index">
	<h2><?php __('Didyoumean Languages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($didyoumeanLanguages as $didyoumeanLanguage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $didyoumeanLanguage['DidyoumeanLanguage']['id']; ?>&nbsp;</td>
		<td><?php echo $didyoumeanLanguage['DidyoumeanLanguage']['name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $didyoumeanLanguage['DidyoumeanLanguage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $didyoumeanLanguage['DidyoumeanLanguage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $didyoumeanLanguage['DidyoumeanLanguage']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
    <?php echo $this->element('menu'); ?>
    <?php echo $this->element('language_menu'); ?>
</div>