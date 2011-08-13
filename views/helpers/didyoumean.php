<?php
/**
 * Html Helper class file.
 *
 * Simplifies the construction of HTML elements.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @since         CakePHP(tm) v 0.9.1
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Html Helper class for easy use of HTML widgets.
 *
 * HtmlHelper encloses all methods needed while working with HTML pages.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.view.helpers
 * @link http://book.cakephp.org/view/1434/HTML
 */
class DidYouMeanHelper extends AppHelper {
    var $helpers = array('Html');

    function suggestionLink($input,$htmlAttributes = null) {
    // Should not make a link for a suggestion if it's match
	if ($input['type'] != 'match') {
            $link = $this->Html->link(__(sprintf($input['text'],
                $input['suggestion_string']),true),
                array(
                'plugin' => 'didyoumean',
                'controller' => 'didyoumean',
                'action' => 'suggestion',
                'suggestion_string' => $input['suggestion_string'],
                'suggestion_id' => @$input['suggestion_id'],
                'search_id' => $input['search_id']
                ),
                $htmlAttributes
            );
            return $link;
        }
    }

    function suggestionLinks($suggestions ,$htmlAttributes = null) {
        $search_strings = array();
        $output = null;
        foreach ($suggestions as $suggestion) {
            $link = null;
            if ($suggestion['type'] != 'match' &&
                !in_array($suggestion['suggestion_string'], $search_strings)
            ) {
                $output .= $this->suggestionLink($suggestion);
                $search_strings[] = $suggestion['suggestion_string'] ;
                $output .= $link . "<br/><br/>";
                
            }

        }
        return $output;
    }
}
