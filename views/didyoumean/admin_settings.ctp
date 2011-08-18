<table cellpadding="0" cellspacing="0">
    <?php
    $tableHeaders = $this->Html->tableHeaders(array(
                'Name',
                'Description',
                'Value',
                'Type',
                'Action'
            ));
    echo $tableHeaders;

    $rows = array();
    $rows[] = array('Version', 'Version of this plugin', '1.0','','');
    $rows[] = array('No. of searches', 'Search made in this plugin', $search_count ,'', $this->Html->link(__('View', true), array('controller' => 'didyoumean_searches','action' => 'index')));
    $rows[] = array('No. of words in dictionary', 'Words in the dictionary', $word_count ,'', $this->Html->link(__('View', true), array('controller' => 'didyoumean_dictionaries','action' => 'index')));
    $rows[] = array('Add words to the dictionary','', '', '', $this->Html->link(__('Add', true), array('controller' => 'didyoumean_dictionaries','action' => 'import')));
    $rows[] = array('Add words to the dictionary (Using the magic function)','', '', '', $this->Html->link(__('Auto import', true), array('controller' => 'didyoumean_dictionaries','action' => 'magicimport'), null, 'Are you sure?'));

    foreach ($settings AS $setting) {
        $rows[] = array(
           $setting['DidyoumeanSetting']['name'],
           $setting['DidyoumeanSetting']['description'],
           $setting['DidyoumeanSetting']['value'],
           $setting['DidyoumeanSetting']['type'],
           $this->Html->link(__('Edit', true), array('controller' => 'didyoumean','action' => 'edit', $setting['DidyoumeanSetting']['id']))

        );
    }

    echo $this->Html->tableCells($rows);
    echo $tableHeaders;
    ?>
</table>