<div class="didyoumeanDictionaries index">
    <h2><?php __('Dictionary - Words that can be searched for (or a combination of these)'); ?></h2>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Add words', true), array('action' => 'import')); ?></li>
        </ul>
    </div>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('word'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($didyoumeanDictionaries as $didyoumeanDictionary):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
            <tr<?php echo $class; ?>>
                <td><?php echo $didyoumeanDictionary['DidyoumeanDictionary']['id']; ?>&nbsp;</td>
                <td><?php echo $didyoumeanDictionary['DidyoumeanDictionary']['word']; ?>&nbsp;</td>
                <td class="actions">
                <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $didyoumeanDictionary['DidyoumeanDictionary']['id'])); ?>
                <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $didyoumeanDictionary['DidyoumeanDictionary']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $didyoumeanDictionary['DidyoumeanDictionary']['id'])); ?>
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
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
        	 | 	<?php echo $this->Paginator->numbers(); ?>
                |
        <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>