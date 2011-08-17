--
-- Struktur-dump for tabellen `didyoumean_choices`
--

CREATE TABLE IF NOT EXISTS `didyoumean_choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dictionary_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `search_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dictionary_id` (`dictionary_id`,`search_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `didyoumean_choices`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `didyoumean_dictionaries`
--

CREATE TABLE IF NOT EXISTS `didyoumean_dictionaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word_3` (`word`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `didyoumean_dictionaries`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `didyoumean_languages`
--

CREATE TABLE IF NOT EXISTS `didyoumean_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Data dump for tabellen `didyoumean_languages`
--

INSERT INTO `didyoumean_languages` (`id`, `name`) VALUES
(1, 'en'),
(2, 'fr'),
(3, 'es'),
(4, 'dk'),
(5, 'it'),
(6, 'de');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `didyoumean_searches`
--

CREATE TABLE IF NOT EXISTS `didyoumean_searches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` varchar(255) CHARACTER SET latin1 NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `didyoumean_searches`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `didyoumean_settings`
--

CREATE TABLE IF NOT EXISTS `didyoumean_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Data dump for tabellen `didyoumean_settings`
--

INSERT INTO `didyoumean_settings` (`id`, `name`, `description`, `value`, `type`) VALUES
(1, 'enabled', 'enable the didyoumean plugin. Values: true / false', '1', 'boolean'),
(2, 'debug', 'write log when running. Values: true / false', '1', 'boolean'),
(3, 'get_related_words', 'will return related word to the search word if enabled. Values: true / false', '0', 'boolean'),
(4, 'use_cache', 'use cache in some of the function. Values: true / false', '0', 'boolean'),
(5, 'search_url', 'the url where to redirect after the suggestion function. Values: any string %s will be replaced by the search string', '/search/q:%s', 'text'),
(6, 'minimum_user_choice_count', 'the minimum number of choices a suggestion should have before its shown. Values false / any positive integer', '0', 'int'),
(7, 'minimum_user_choice_percentage', 'the minimum percentage (user choices / search on this word) of choices a suggestion should have before its shown. Values false / any positive integer <= 100', '0', 'int'),
(8, 'help', 'Write to a log file if a search does not return any suggestions?. Values true / false', '1', 'boolean'),
(9, 'language', 'Default language when Configure::read(language) returns false', 'en', 'text'),
(10, 'text_en', 'The didyoumean text when suggesting new search in english', 'Did you mean "%s"?', 'text'),
(12, 'text_dk', 'The didyoumean text when suggesting new search in danish', 'Mente du "%s"?', 'text'),
(13, 'text_de', 'The didyoumean text when suggesting new search in german', 'Meinten Sie "%s"?', 'text'),
(14, 'text_fr', 'The didyoumean text when suggesting new search in french', 'Vouliez-vous dire "s%"?', 'text'),
(15, 'text_it', 'The didyoumean text when suggesting new search in italian', 'Forse cercavi "s%"?', 'text');
