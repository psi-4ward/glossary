<?php

/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['glossary'] = array
(
	'tables' => array('tl_glossary', 'tl_glossary_term'),
	'icon'   => 'system/modules/glossary/assets/icon.gif'
);


/**
 * Add front end modules
 */
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'glossary' => array
	(
		'glossaryList' => 'Glossary\Module\Listing'
	)
));


// Hook for term-links
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = array('Glossary\Links', 'replaceTerms');
