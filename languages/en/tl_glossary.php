<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005-2011
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Glossary
 * @license    LGPL
 * @filesource
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_glossary']['title']  = array('Title', 'Please enter the glossary title.');
$GLOBALS['TL_LANG']['tl_glossary']['tstamp'] = array('Revision date', 'Date and time of the latest revision');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_glossary']['title_legend'] = 'Title';


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_glossary']['deleteConfirm'] = 'Deleting a glossary will also delete all its terms! Do you really want to delete glossary ID %s?';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_glossary']['new']    = array('New glossary', 'Create a new glossary');
$GLOBALS['TL_LANG']['tl_glossary']['show']   = array('Glossary details', 'Show the details of glossary ID %s');
$GLOBALS['TL_LANG']['tl_glossary']['edit']   = array('Edit glossary', 'Edit glossary ID %s');
$GLOBALS['TL_LANG']['tl_glossary']['copy']   = array('Duplicate glossary', 'Duplicate glossary ID %s');
$GLOBALS['TL_LANG']['tl_glossary']['delete'] = array('Delete glossary', 'Delete glossary ID %s');

?>