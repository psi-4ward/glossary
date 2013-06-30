<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['glossaryList'] = '{title_legend},name,headline,type;{config_legend},glossaries,glossaryTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['glossaries'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['glossaries'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_glossary.title',
	'eval'                    => array('multiple'=>true, 'mandatory'=>true, 'tl_class'=>'w50'),
	'sql'					  => 'text NULL'
);
$GLOBALS['TL_DCA']['tl_module']['fields']['glossaryTpl'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['glossaryTpl'],
	'exclude'                 => true,
	'default'				  => 'mod_glossary_list_default',
	'inputType'               => 'select',
	'options'				  => $this->getTemplateGroup('mod_glossary_list_'),
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
	'sql'					  => "varchar(128) NOT NULL default 'mod_glossary_list_default'"
);
