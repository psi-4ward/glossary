<?php

use Contao\ArrayUtil;
use Laemmi\ContaoGlossaryBundle\Links;
use Laemmi\ContaoGlossaryBundle\Module\Listing;

/**
 * Add back end modules
 */

$GLOBALS['BE_MOD']['content']['glossary'] =
    [
    'tables' => ['tl_glossary', 'tl_glossary_term'],
    'icon'   => 'system/modules/glossary/assets/icon.gif'
    ];


/**
 * Add front end modules
 */
ArrayUtil::arrayInsert(
    $GLOBALS['FE_MOD'],
    4,
    [
    'glossary' =>
        [
        'glossaryList' => Listing::class
        ]
    ]
);


// Hook for term-links
$GLOBALS['TL_HOOKS']['outputFrontendTemplate'][] = [Links::class, 'replaceTerms'];
