<?php

/**
 * Table tl_glossary
 */

$GLOBALS['TL_DCA']['tl_glossary'] = [
    // Config
    'config' => [
        'dataContainer' => 'Table',
        'ctable' => ['tl_glossary_term'],
        'switchToEdit' => true,
        'enableVersioning' => true,
        'sql' => [
            'keys' => ['id' => 'primary']]
    ],
    // List
    'list' => [
        'sorting' => [
            'mode' => 1,
            'fields' => ['title'],
            'flag' => 1,
            'panelLayout' => 'search,limit'
        ],
        'label' => [
            'fields' => ['title'],
            'format' => '%s'
        ],
        'global_operations' => [
            'all' => [
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            ]
        ],
        'operations' => [
            'edit' => [
                'label' => &$GLOBALS['TL_LANG']['tl_glossary']['edit'],
                'href' => 'table=tl_glossary_term',
                'icon' => 'edit.gif'
            ],
            'editheader' => [
                'label' => &$GLOBALS['TL_LANG']['tl_glossary']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.gif'
            ],
            'copy' => [
                'label' => &$GLOBALS['TL_LANG']['tl_glossary']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ],
            'delete' => [
                'label' => &$GLOBALS['TL_LANG']['tl_glossary']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['tl_glossary']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"'
            ],
            'show' => [
                'label' => &$GLOBALS['TL_LANG']['tl_glossary']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            ]
        ]
    ],
    'palettes' => [
        '__selector__' => ['glossarylinks'],
        'default' => '{title_legend},title;{glossarylinks_legend:hide},glossarylinks'
    ],
    'subpalettes' => [
        'glossarylinks' => 'glossarylinks_template,glossarylinks_pages,glossarylinks_pagesInvert,glossarylinks_disallowintags,glossarylinks_allowtagsindesc'
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'title' => [
            'label' => &$GLOBALS['TL_LANG']['tl_glossary']['title'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => [
                'mandatory' => true,
                'maxlength' => 255
            ],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'glossarylinks' => [
            'label' => ($GLOBALS['TL_LANG']['tl_glossary']['glossarylinks'] ?? null),
            'exclude' => true,
            'filter' => true,
            'inputType' => 'checkbox',
            'eval' => [
                'submitOnChange' => true,
                'tl_class' => 'w50'
            ],
            'sql' => "char(1) NOT NULL default ''"
        ],
        'glossarylinks_template' => [
            'label' => &$GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_template'],
            'default' => 'glossarylinks_default',
            'exclude' => true,
            'inputType' => 'select',
            'options' => $this->getTemplateGroup('glossarylinks_'),
            'eval' => ['tl_class' => 'clr'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'glossarylinks_pages' => [
            'label' => ($GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_pages'] ?? null),
            'explanation' => 'glossarylinks_pages',
            'exclude' => true,
            'inputType' => 'pageTree',
            'eval' => [
                'multiple' => true,
                'fieldType' => 'checkbox',
                'files' => true,
                'tl_class' => 'clr',
                'csv' => ','
            ], 'sql' => "blob NULL"
        ],
        'glossarylinks_pagesInvert' => [
            'label' => ($GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_pagesInvert'] ?? null),
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => [
                'tl_class' => 'w50'
            ],
            'sql' => "char(1) NOT NULL default ''"
        ],
        'glossarylinks_disallowintags' => [
            'label' => ($GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_disallowintags'] ?? null),
            'exclude' => true,
            'default' => '<script>,<style>',
            'inputType' => 'textarea',
            'eval' => [
                'tl_class' => 'clr',
                'decodeEntities' => true,
                'preserveTags' => true,
                'class' => 'monospace'
            ],
            'sql' => "text NULL"
        ],
        'glossarylinks_allowtagsindesc' => [
            'label' => ($GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_allowtagsindesc'] ?? null),
            'exclude' => true,
            'inputType' => 'textarea',
            'eval' => [
                'tl_class' => 'clr',
                'decodeEntities' => true,
                'preserveTags' => true,
                'class' => 'monospace'
            ],
            'sql' => "text NULL"
        ]
    ],
];
