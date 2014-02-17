<?php

\Contao\ClassLoader::addNamespace('Psi');

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Psi\Glossary\Module\Listing' 	=> 'system/modules/glossary/Module/Listing.php',
	'Psi\Glossary\Links' 			=> 'system/modules/glossary/classes/Links.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_glossary_list_default'         => 'system/modules/glossary/templates',
	'mod_glossary_list_anchorMenu'      => 'system/modules/glossary/templates',
	'mod_glossary_list_modern_jQuery'   => 'system/modules/glossary/templates',
	'glossarylinks_default' 	        => 'system/modules/glossary/templates',
));
