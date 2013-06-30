<?php

/**
 * Table tl_glossary
 */
$GLOBALS['TL_DCA']['tl_glossary'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_glossary_term'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_glossary']['edit'],
				'href'                => 'table=tl_glossary_term',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_glossary']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_glossary']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_glossary']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['tl_glossary']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_glossary']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	'palettes' => array
	(
		'__selector__'				  => array('glossarylinks'),
		'default'                     => '{title_legend},title;{glossarylinks_legend:hide},glossarylinks',
	),

	'subpalettes' => array
	(
		'glossarylinks' 			  => 'glossarylinks_template,glossarylinks_pages,glossarylinks_pagesInvert,glossarylinks_disallowintags,glossarylinks_allowtagsindesc'
	),

	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_glossary']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'glossarylinks'	=> array
		(
			'label'					  => $GLOBALS['TL_LANG']['tl_glossary']['glossarylinks'],
			'exclude'				  => true,
			'filter'				  => true,
			'inputType'				  => 'checkbox',
			'eval'					  => array('submitOnChange' => true, 'tl_class'=>'w50'),
			'sql'					  => "char(1) NOT NULL default ''"
		),
		'glossarylinks_template' => array
		(
			'label'					  => &$GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_template'],
			'default'                 => 'glossarylinks_default',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => $this->getTemplateGroup('glossarylinks_'),
			'eval'                    => array('tl_class'=>'clr'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'glossarylinks_pages' => array
		(
			'label'					  => $GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_pages'],
			'explanation'   		  => 'glossarylinks_pages',
			'exclude'				  => true,
			'inputType'				  => 'pageTree',
			'eval'					  => array('multiple'=>true, 'fieldType'=>'checkbox', 'files'=>true, 'tl_class'=>'clr', 'csv'=>','),
			'sql'                     => "blob NULL"
		),
		'glossarylinks_pagesInvert'	=> array
		(
			'label'					  => $GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_pagesInvert'],
			'exclude'				  => true,
			'inputType'				  => 'checkbox',
			'eval'					  => array('tl_class'=>'w50'),
			'sql'					  => "char(1) NOT NULL default ''"
		),
		'glossarylinks_disallowintags' => array
		(
			'label'			  	      => $GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_disallowintags'],
			'exclude'		  	      => true,
			'default'				  => '<script>,<style>',
			'inputType'		  	      => 'textarea',
			'eval'			  	      => array('tl_class'=>'clr', 'decodeEntities'=>true, 'preserveTags'=>true, 'class'=>'monospace'),
			'sql'                     => "text NULL"
		),
		'glossarylinks_allowtagsindesc' => array
		(
			'label'					  => $GLOBALS['TL_LANG']['tl_glossary']['glossarylinks_allowtagsindesc'],
			'exclude'				  => true,
			'inputType'				  => 'textarea',
			'eval'					  => array('tl_class'=>'clr', 'decodeEntities'=>true, 'preserveTags'=>true, 'class'=>'monospace'),
			'sql'                     => "text NULL"
		),
	)
);
