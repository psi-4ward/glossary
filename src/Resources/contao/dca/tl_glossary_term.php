<?php

$this->loadLanguageFile('tl_content');

/**
 * Table tl_glossary_term
 */
$GLOBALS['TL_DCA']['tl_glossary_term'] = [
    // Config
    'config' => ['dataContainer' => 'Table',
        'ptable' => 'tl_glossary',
        'enableVersioning' => true,
        'sql' => ['keys' => ['id' => 'primary', 'pid' => 'index']]],
    // List
    'list' => ['sorting' => ['mode' => 4, 'fields' => ['term'], 'headerFields' => ['title', 'tstamp'], 'panelLayout' => 'filter;search,limit', 'child_record_callback' => ['tl_glossary_term', 'listTerms']], 'global_operations' => ['all' => ['label' => &$GLOBALS['TL_LANG']['MSC']['all'], 'href' => 'act=select', 'class' => 'header_edit_all', 'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"']], 'operations' => ['edit' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['edit'], 'href' => 'act=edit', 'icon' => 'edit.gif'], 'copy' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['copy'], 'href' => 'act=paste&amp;mode=copy', 'icon' => 'copy.gif'], 'cut' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['cut'], 'href' => 'act=paste&amp;mode=cut', 'icon' => 'cut.gif'], 'delete' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['delete'], 'href' => 'act=delete', 'icon' => 'delete.gif', 'attributes' => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"'], 'toggle' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['toggle'], 'icon' => 'visible.gif', 'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"', 'button_callback' => ['tl_glossary_term', 'toggleIcon']], 'show' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['show'], 'href' => 'act=show', 'icon' => 'show.gif']]],
    // Palettes
    'palettes' => ['__selector__' => ['addImage', 'addEnclosure'], 'default' => '{title_legend},term,glossarytype,author;{definition_legend},definition;{image_legend},addImage;{enclosure_legend:hide},addEnclosure;{publish_legend},published'],
    // Subpalettes
    'subpalettes' => ['addImage' => 'singleSRC,alt,size,imagemargin,imageUrl,fullsize,caption,floating', 'addEnclosure' => 'enclosure'],
    // Fields
    'fields' => ['id' => ['sql' => "int(10) unsigned NOT NULL auto_increment"], 'pid' => ['foreignKey' => 'tl_glossary.title', 'sql' => "int(10) unsigned NOT NULL default '0'", 'relation' => ['type' => 'belongsTo', 'load' => 'eager']], 'tstamp' => ['sql' => "int(10) unsigned NOT NULL default '0'"], 'term' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['term'], 'exclude' => true, 'search' => true, 'flag' => 1, 'inputType' => 'text', 'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'], 'sql' => "varchar(255) NOT NULL default ''"], 'glossarytype' => ['label' => ($GLOBALS['TL_LANG']['tl_glossary_term']['glossarytype'] ?? null), 'exclude' => true, 'inputType' => 'select', 'options' => ['dfn' => ($GLOBALS['TL_LANG']['glossarylinks']['dfn'] ?? null), 'abbr' => ($GLOBALS['TL_LANG']['glossarylinks']['abbr'] ?? null)], 'eval' => ['tl_class' => 'w50'], 'sql' => "varchar(32) NOT NULL default ''"], 'author' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['author'], 'default' => \BackendUser::getInstance()->id, 'exclude' => true, 'search' => true, 'inputType' => 'select', 'foreignKey' => 'tl_user.name', 'eval' => ['doNotCopy' => true, 'mandatory' => true, 'includeBlankOption' => true, 'tl_class' => 'w50'], 'sql' => "int(10) unsigned NOT NULL default '0'"], 'definition' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['definition'], 'exclude' => true, 'search' => true, 'inputType' => 'textarea', 'eval' => ['mandatory' => true, 'rte' => 'tinyMCE', 'helpwizard' => true], 'explanation' => 'insertTags', 'sql' => "text NULL"], 'addImage' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['addImage'], 'exclude' => true, 'inputType' => 'checkbox', 'eval' => ['submitOnChange' => true], 'sql' => "char(1) NOT NULL default ''"], 'singleSRC' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'], 'exclude' => true, 'inputType' => 'fileTree', 'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr'], 'sql' => "binary(16) NULL"], 'alt' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['alt'], 'exclude' => true, 'inputType' => 'text', 'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'long'], 'sql' => "varchar(255) NOT NULL default ''"], 'size' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['size'], 'exclude' => true, 'inputType' => 'imageSize', 'options' => ['crop', 'proportional', 'box'], 'reference' => &$GLOBALS['TL_LANG']['MSC'], 'eval' => ['rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50'], 'sql' => "varchar(255) NOT NULL default ''"], 'imagemargin' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['imagemargin'], 'exclude' => true, 'inputType' => 'trbl', 'options' => ['px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'], 'eval' => ['includeBlankOption' => true, 'tl_class' => 'w50'], 'sql' => "varchar(255) NOT NULL default ''"], 'imageUrl' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['imageUrl'], 'exclude' => true, 'search' => true, 'inputType' => 'text', 'eval' => ['rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'w50 wizard'], 'wizard' => [['tl_glossary_term', 'pagePicker']], 'sql' => "varchar(255) NOT NULL default ''"], 'fullsize' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['fullsize'], 'exclude' => true, 'inputType' => 'checkbox', 'eval' => ['tl_class' => 'w50 m12'], 'sql' => "char(1) NOT NULL default ''"], 'caption' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['caption'], 'exclude' => true, 'search' => true, 'inputType' => 'text', 'eval' => ['maxlength' => 255, 'tl_class' => 'w50'], 'sql' => "varchar(255) NOT NULL default ''"], 'floating' => ['label' => &$GLOBALS['TL_LANG']['tl_content']['floating'], 'exclude' => true, 'inputType' => 'radioTable', 'options' => ['above', 'left', 'right', 'below'], 'eval' => ['cols' => 4, 'tl_class' => 'w50'], 'reference' => &$GLOBALS['TL_LANG']['MSC'], 'sql' => "varchar(32) NOT NULL default ''"], 'addEnclosure' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['addEnclosure'], 'exclude' => true, 'inputType' => 'checkbox', 'eval' => ['submitOnChange' => true], 'sql' => "char(1) NOT NULL default ''"], 'enclosure' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['enclosure'], 'exclude' => true, 'inputType' => 'fileTree', 'eval' => ['filesOnly' => true, 'fieldType' => 'checkbox', 'multiple' => true, 'mandatory' => true, 'tl_class' => 'clr'], 'sql' => "blob NULL"], 'published' => ['label' => &$GLOBALS['TL_LANG']['tl_glossary_term']['published'], 'exclude' => true, 'filter' => true, 'flag' => 2, 'inputType' => 'checkbox', 'eval' => ['doNotCopy' => true], 'sql' => "char(1) NOT NULL default ''"]],
];


class tl_glossary_term extends \Backend
{
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * List all terms
     * @param array
     * @return string
     */
    public function listTerms($arrRow)
    {
        $key = $arrRow['published'] ? 'published' : 'unpublished';

        return '
<div class="cte_type ' . $key . '">' . $arrRow['term'] . '</div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h32' : '') . ' block">
' . $arrRow['definition'] . '
</div>' . "\n";
    }

    /**
     * Return the link picker wizard
     *
     * @return string
     * @internal param $object
     */
    public function pagePicker(\DataContainer $dc)
    {
        $strField = 'ctrl_' . $dc->field . (($this->Input->get('act') == 'editAll') ? '_' . $dc->id : '');
        return ' ' . \Image::getHtml('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top; cursor:pointer;" onclick="Backend.pickPage(\'' . $strField . '\')"');
    }

    /**
     * Return the "toggle visibility" button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen((string)Input::get('tid'))) {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
            $this->redirect($this->getReferer());
        }

        // Check permissions AFTER checking the tid, so hacking attempts are logged
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_glossary_term::published', 'alexf')) {
            return '';
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {
            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

    /**
     * Disable/enable a user group
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        // Check permissions to publish
        if (!$this->User->isAdmin && !$this->User->hasAccess('tl_glossary_term::published', 'alexf')) {
            $this->log('Not enough permissions to publish/unpublish Glossary-Term ID "' . $intId . '"', 'tl_glossary_term toggleVisibility', TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $objVersions = new Versions('tl_glossary_term', $intId);
        $objVersions->initialize();

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_glossary_term']['fields']['published']['save_callback'])) {
            foreach ($GLOBALS['TL_DCA']['tl_glossary_term']['fields']['published']['save_callback'] as $callback) {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_glossary_term SET tstamp=" . time() . ", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
            ->execute($intId);

        $objVersions->create();
        $this->log('A new version of record "tl_glossary_term.id=' . $intId . '" has been created' . $this->getParentEntries('tl_glossary_term', $intId), 'tl_glossary_term toggleVisibility()', TL_GENERAL);
    }
}
