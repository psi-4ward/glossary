<?php

namespace Laemmi\ContaoGlossaryBundle\Module;

class Listing extends \Module
{
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### GLOSSARY LIST ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        $this->glossaries = deserialize($this->glossaries);

        // Return if there are no glossaries
        if (!is_array($this->glossaries) || count($this->glossaries) < 1) {
            return '';
        }
        $this->strTemplate = $this->glossaryTpl;

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile()
    {
        $objTerm = $this->Database->execute(
            "SELECT * FROM tl_glossary_term WHERE pid IN(" .
            implode(',', array_map('intval', $this->glossaries)) . ")" . " ORDER BY term"
        );

        if ($objTerm->numRows < 1) {
            $this->Template->terms = [];
            return;
        }

        $this->import('StringUtil', 'String');
        $arrTerms = [];

        while ($objTerm->next()) {
            $objTemp = new \FrontendTemplate();
            $key = utf8_substr($objTerm->term, 0, 1);

            $objTemp->term = $objTerm->term;
            $objTemp->anchor = 'gl' . utf8_romanize($key);
            $objTemp->id = standardize($objTerm->term);

            // Clean the RTE output
            if ($GLOBALS['objPage']->outputFormat == 'xhtml') {
                $objTerm->definition = $this->String->toXhtml($objTerm->definition);
            } else {
                $objTerm->definition = $this->String->toHtml5($objTerm->definition);
            }

            $objTemp->definition = $this->String->encodeEmail($objTerm->definition);
            $objTemp->addImage = false;

            // Add image
            if ($objTerm->addImage && $objTerm->singleSRC) {
                if (!is_numeric($objTerm->singleSRC) && !\Validator::isUuid($objTerm->singleSRC)) {
                    $this->Template->hl = 'h1';
                    $this->Template->headline = sprintf(
                        "<p class=\"error\">%s</p>",
                        $GLOBALS['TL_LANG']['ERR']['version2format']
                    );
                } else {
                    $objModel = \FilesModel::findByPk($objTerm->singleSRC);

                    if ($objModel !== null && is_file(TL_ROOT . '/' . $objModel->path)) {
                        $objTerm->singleSRC = $objModel->path;
                        $this->addImageToTemplate($objTemp, $objTerm->row());
                    }
                }
            }

            $objTemp->enclosures = [];

            // Add enclosures
            if ($objTerm->addEnclosure) {
                $this->addEnclosuresToTemplate($objTemp, $objTerm->row());
            }

            $arrTerms[$key][] = $objTemp;
        }

        $this->Template->terms = $arrTerms;
        $this->Template->request = $this->generateFrontendUrl($GLOBALS['objPage']->row());
        $this->Template->topLink = $GLOBALS['TL_LANG']['MSC']['backToTop'];
    }
}
