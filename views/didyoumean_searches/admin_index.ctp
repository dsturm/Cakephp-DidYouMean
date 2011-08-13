<div class="didyoumeanSearches index">
    <h2><?php __('Didyoumean Searches');?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id');?></th>
            <th><?php echo $this->Paginator->sort('string');?></th>
            <th><?php echo $this->Paginator->sort('count');?></th>
            <th>Language</th>
            <!--th>Will return</th>
            <th>User choices</th-->

        </tr>
        <?php
        $i = 0;
        //pr($didyoumeanSearches);
        foreach ($didyoumeanSearches as $didyoumeanSearch):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
        <tr<?php echo $class;?>>
            <td><?php echo $didyoumeanSearch['DidyoumeanSearch']['id']; ?>&nbsp;</td>
            <td><?php echo $didyoumeanSearch['DidyoumeanSearch']['string']; ?>&nbsp;</td>
            <td><?php echo $didyoumeanSearch['DidyoumeanSearch']['count']; ?>&nbsp;</td>
            <td><?php echo $didyoumeanSearch['DidyoumeanLanguage']['name']; ?>&nbsp;</td>
            <!--td>
                    <?php
                    /*if (!empty($didyoumeanSearch['return'])) {
                        foreach ($didyoumeanSearch['return'] as $return) {
                            echo $return['suggestion_string'] . "(".$return['type'].")<br/>";
                        }
                    }
                    ?>
            </td>
            <td>
                    <?php
                    if (!empty($didyoumeanSearch['DidyoumeanChoice'])) {
                        foreach ($didyoumeanSearch['DidyoumeanChoice'] as $choice) {
                            echo $choice['DidyoumeanDictionary']['word']."(". $choice['count'] .")<br/>";
                        }
                    }else {
                        echo "No user choices for this word<br/>";
                    }
                    
                    if($didyoumeanSearch['InDictionary'] == false) {
                    //echo $this->Html->link("This word is not in the dictionary. Do you want to add it?",array('plugin' => 'didyoumean','controller' => 'didyoumean_dictionaries','action' => 'addWord', $didyoumeanSearch['DidyoumeanSearch']['string']));
                    }
                     *
                     */
                    ?>
            </td-->
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
</div>