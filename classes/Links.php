<?php 

namespace Psi\Glossary;

/**
 * Class GlossaryLinks - scrape the template content for glossar keywords and return the result.
 *
 * @copyright	2009 CyberSpectrum
 * @author		Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @package		Controller
 */
class Links extends \Frontend
{

	// Tags, in which no replacement will be done.
	private $arrProtectedTags = array('html', 'title', 'meta', 'style', 'script', 'textarea', 'a', 'label', 'dfn class="glossarydescription"', 'abbr class="glossarydescription"');
	private $cachedProtectedPlain = NULL;
	private $cachedProtectedDOMs = NULL;
	private $cachedAllow = NULL;


	protected function buildProtectedSelectors()
	{
		$cachedDisallow=array();
		$cachedProtectedPlain=array();
		$cachedProtectedPlain['global']=array();
		$cachedAllow=array();
		foreach($this->arrProtectedTags as $tagEntry)
		{
			// if we do not have a space in the selector, there is no attribute specified, 
			// we can savely continue then
			if(strpos($tagEntry, ' ') === false)
			{
				$cachedProtectedPlain['global'][]=$tagEntry;
				continue;
			}
			$dummy='<test><'.$tagEntry.'/></test>';
			$cachedDisallow['global'][] = str_get_html($dummy);
		}
		$obj = $this->Database->prepare("
				SELECT g.id, g.glossarylinks_disallowintags AS disallow, g.glossarylinks_allowtagsindesc AS allow
				FROM tl_glossary AS g
				WHERE g.glossarylinks=1 AND (g.glossarylinks_pagesInvert='' AND FIND_IN_SET(?, g.glossarylinks_pages) OR g.glossarylinks_pagesInvert='1' AND NOT FIND_IN_SET(?, g.glossarylinks_pages))
				ORDER BY g.glossarylinks_template")
			->execute($GLOBALS['objPage']->id, $GLOBALS['objPage']->id);
		if ($obj->numRows)
		{
			if($obj->disallow != '')
			{
				$notAllowedTags = explode(',', preg_replace('([<|>])', '', $obj->disallow));
				$cachedProtectedPlain[$obj->id]=array_merge($cachedProtectedPlain['global'], $notAllowedTags);
				$cachedDisallow[$obj->id]=$cachedDisallow['global'];
				foreach($notAllowedTags as $tagEntry)
				{
					// if we do not have a space in the selector, there is no attribute specified, 
					// we can savely continue then
					if(strpos($tagEntry, ' ') === false)
					{
						$cachedProtectedPlain[$obj->id][]=$tagEntry;
						continue;
					}
					$dummy='<test><'.$tagEntry.'/></test>';
					$cachedDisallow[$obj->id][] = str_get_html($dummy);
				}
			} else {
				$cachedProtectedPlain[$obj->id]=$cachedProtectedPlain['global'];
				$cachedDisallow[$obj->id]=$cachedDisallow['global'];
			}
			if($obj->allow != '')
			{
				$cachedAllow[$obj->id]=implode(explode(',', $obj->allow));
			}
		}
		$this->cachedProtectedDOMs=$cachedDisallow;
		$this->cachedProtectedPlain=$cachedProtectedPlain;
		$this->cachedAllow=$cachedAllow;
	}


	protected function isForbiddenTag($node, $pid)
	{
		$parentTag=$node->parent()->tag;
		// short exit way, the tag is disabled in total.
		if(in_array($parentTag, $this->cachedProtectedPlain[$pid]))
			return true;
		$parent=$node->parent();
		// now we have to check for tags with given selectors.
		foreach($this->cachedProtectedDOMs[$pid] as $tagEntry)
		{
			$forbidden=true;
			if($tagEntry->root->firstChild()->firstChild()->tag != $parentTag)
				continue;
			foreach(($tagEntry->root->firstChild()->firstChild()->getAllAttributes()) as $key=>$attrib)
			{
				// attribute not specified? continue with next tag.
				if(!$parent->hasAttribute($key))
				{
					$forbidden=false;
					break;
				}
				if($parent->getAttribute($key) != $attrib)
				{
					$forbidden=false;
					break;
				}
			}
			if($forbidden)
			{
				return true;
			}
		}
		return false;
	}

	
	/**
	 * Called from parseFrontendTemplate HOOK
	 * @param string
	 * @param object
	 * @return string
	 */
	public function replaceTerms($strBuffer, $strTemplate)
	{
		// Include SimpleHtmlDom
		if (!function_exists('file_get_html'))
			require_once(TL_ROOT . '/system/modules/glossary/classes/simple_html_dom.php');
		$this->buildProtectedSelectors();
		$obj = $this->Database->prepare("
				SELECT gt.*, g.glossarylinks_template
				FROM tl_glossary AS g
				RIGHT JOIN tl_glossary_term AS gt ON (gt.pid=g.id)
				WHERE g.glossarylinks=1 AND (g.glossarylinks_pagesInvert='' AND FIND_IN_SET(?, g.glossarylinks_pages) OR g.glossarylinks_pagesInvert='1' AND NOT FIND_IN_SET(?, g.glossarylinks_pages))
				ORDER BY g.glossarylinks_template, LENGTH(term) DESC")
			->execute($GLOBALS['objPage']->id, $GLOBALS['objPage']->id);
		if ($obj->numRows)
		{
			$lasttpl='glossarylinks_default';
			$objTemplate=new \FrontendTemplate($lasttpl);
			while($obj->next())
			{
				if(stripos($strBuffer, trim($obj->term)) !== false)
				{
					$html = str_get_html($strBuffer);
					foreach($html->find('text') as $text ) {
						if ($this->isForbiddenTag($text, $obj->pid))
						{
							$text->parent()->nextSibling();
							continue;
						} else {
							if($obj->term == '' || strpos($text->innertext, $obj->term)===false)
							{
								continue;
							}
							if($lasttpl != $obj->glossarylinks_template)
							{
								$lasttpl=$obj->glossarylinks_template;
								$objTemplate=new FrontendTemplate($lasttpl);
							}
							$objTemplate->id = $obj->id;
							$objTemplate->author = $obj->author;
							$objTemplate->term = $obj->term;
							$objTemplate->definition = trim(strip_tags($obj->definition, $this->cachedAllow[$obj->pid]));
							$objTemplate->addImage = $obj->addImage;
							$objTemplate->singleSRC = $obj->singleSRC;
							$objTemplate->size = $obj->size;
							$objTemplate->alt = $obj->alt;
							$objTemplate->caption = $obj->caption;
							$objTemplate->floating = $obj->floating;
							$objTemplate->imagemargin = $obj->imagemargin;
							$objTemplate->fullsize = $obj->fullsize;
							$objTemplate->addEnclosure = $obj->addEnclosure;
							$objTemplate->enclosure = $obj->enclosure;
							$objTemplate->glossarytype = $obj->glossarytype;
							$objTemplate->cssId = 'glossary_' . $obj->pid;
							$text->innertext = preg_replace ( "#\b(".trim($obj->term).")\b#uis", $objTemplate->parse(), $text->innertext); 
						}
					}
					$strBuffer = $html->save();
					$html->clear();
					unset($html);
				}
			}
			unset($obj);
		}
		return $strBuffer;
	}
}
