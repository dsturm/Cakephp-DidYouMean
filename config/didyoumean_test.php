<?php
    // enable the didyoumean plugin. Values: true / false
    $config['Didyoumean']['enabled'] = true;
    // write log when running. Values: true / false
    $config['Didyoumean']['debug'] = true;
    // will return related word to the search word if enabled. Values: true / false
    $config['Didyoumean']['get_related_words'] = true;
    // use cache in some of the function. Values: true / false
    $config['Didyoumean']['use_cache'] = false;
    // the url where to redirect after the suggestion function. Values: any string %s will be replaced by the search string
    $config['Didyoumean']['search_url'] = '/users/index/%s';
    // the minimum number of choices a suggestion should have before its shown. Values false / any positive integer
    $config['Didyoumean']['minimum_user_choice_count'] = false;
    // the minimum percentage (user choices / search on this word) of choices a suggestion should have before its shown. Values false / any positive integer <= 100
    $config['Didyoumean']['minimum_user_choice_percentage'] = false;
    // Write to a log file if a search does not return any suggestions?. Values true / false
    $config['Didyoumean']['help'] = true;
    // Default language when Configure::read('language'); returns false
    $config['Didyoumean']['language'] = 'eng';
?>
