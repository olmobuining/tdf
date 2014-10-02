<?php

/**
 * page actions.
 *
 * @package    tdf
 * @subpackage page
 * @author     Olmo Buining
 */
class pageActions extends myActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeIndex(sfWebRequest $request) {
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		// SET META
		$this->getResponse()->addMeta('description', 'De homepage van The Dutch Fellowship. Een Nederlands sprekende guild, in Guild wars 2.');
		$this->getResponse()->addMeta('keywords', 'homepage, home, pagina,  page, dutch, nederlands, guild, Nederland, NL, BE, NL/BE, belgisch, nederlandse guild, belgische guild, guild wars 2, casual, pve, pvp, WvW, WvWvW, recruiting, grote guild, kleine guild, gezellige guild, professionele guild, non-profit, games, game, gamers, begin pagina, begin, aanmelden, apply, release date, release date guild wars 2, guild wars, gw2, gw2 guild, dutch gw2 guild, dutch gw2, belgische gw2, belgische gw2 guild');
		$this->setTitle(' Homepage ');
		$this->charLogReq = sfConfig::get('app_permissions_see_char_log');
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}
	}
  
	public function executeDonate(sfWebRequest $request)
	{
		$this->char = Doctrine::getTable('myCharacterLog')->findOneById(1);
		// SET META
		$this->getResponse()->addMeta('description', 'Help onze guild door een bedrag te doneren.');
		$this->getResponse()->addMeta('keywords', 'homepage, home, pagina,  page, dutch, nederlands, guild, Nederland, NL, BE, NL/BE, belgisch, nederlandse guild, belgische guild, guild wars 2, casual, pve, pvp, WvW, WvWvW, recruiting, grote guild, kleine guild, gezellige guild, professionele guild, non-profit, games, game, gamers, begin pagina, begin, aanmelden, apply, release date, release date guild wars 2, guild wars, gw2, gw2 guild, dutch gw2 guild, dutch gw2, belgische gw2, belgische gw2 guild, doneren, bedrag, help onze guild, helpen');
		$this->setTitle(' Donate ');
		/* Tags Cloud */
		$tags = array();
		$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
		foreach ($blogsTags as $blog) {
			foreach ($blog->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		$imageTags = Doctrine::getTable('Image')->getAll();
		foreach ($imageTags as $image) {
			foreach ($image->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		// Send tags array to template
		shuffle($tags);
		$this->tags = $tags;
	}
  
  public function executeDonateThanks(sfWebRequest $request)
  {
	// SET META
	$this->getResponse()->addMeta('description', 'Help onze guild door een bedrag te doneren.');
	$this->setTitle(' Bedankt! ');
	/* Tags Cloud */
		$tags = array();
		$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
		foreach ($blogsTags as $blog) {
			foreach ($blog->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		$imageTags = Doctrine::getTable('Image')->getAll();
		foreach ($imageTags as $image) {
			foreach ($image->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		// Send tags array to template
		shuffle($tags);
		$this->tags = $tags;
	  
  }
  
  
  public function executeAboutUs(sfWebRequest $request)
  {
		/* Tags Cloud */
		$tags = array();
		$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
		foreach ($blogsTags as $blog) {
			foreach ($blog->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		$imageTags = Doctrine::getTable('Image')->getAll();
		foreach ($imageTags as $image) {
			foreach ($image->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		// Send tags array to template
		shuffle($tags);
		$this->tags = $tags;
		
		
	// SET META
	$this->getResponse()->addMeta('description', 'Alles over The Dutchfellowship. Een guild begonnen als Brothers of War overgegaan naar een beter passende naam.');
	$this->getResponse()->addMeta('keywords', 'homepage, home, pagina,  page, dutch, nederlands, guild, Nederland, NL, BE, NL/BE, belgisch, nederlandse guild, belgische guild, guild wars 2, casual, pve, pvp, WvW, WvWvW, recruiting, grote guild, kleine guild, gezellige guild, professionele guild, non-profit, games, game, gamers, begin pagina, begin, aanmelden, apply, release date, release date guild wars 2, guild wars, gw2, gw2 guild, dutch gw2 guild, dutch gw2, belgische gw2, belgische gw2 guild');
	$this->setTitle('Over The Dutch Fellowship ', false, ' Nederlandse Guild', '|');
	
  }
  
  
  public function executeWelcome(sfWebRequest $request)
  {
		/* Tags Cloud */
		$tags = array();
		$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
		foreach ($blogsTags as $blog) {
			foreach ($blog->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		$imageTags = Doctrine::getTable('Image')->getAll();
		foreach ($imageTags as $image) {
			foreach ($image->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		// Send tags array to template
		shuffle($tags);
		$this->tags = $tags;
		
		
	// SET META
	$this->getResponse()->addMeta('description', 'Welkoms pagina van The Dutch Fellowship. Een NL / BE Guild in Guild Wars 2.');
	$this->getResponse()->addMeta('keywords', 'homepage, home, pagina,  page, dutch, nederlands, guild, Nederland, NL, BE, NL/BE, belgisch, nederlandse guild, belgische guild, guild wars 2, casual, pve, pvp, WvW, WvWvW, recruiting, grote guild, kleine guild, gezellige guild, professionele guild, non-profit, games, game, gamers, begin pagina, begin, aanmelden, apply, release date, release date guild wars 2, guild wars, gw2, gw2 guild, dutch gw2 guild, dutch gw2, belgische gw2, belgische gw2 guild, welkoms pagina, welkom bij onze guild, The Dutch Fellowship, TDF, TDF guild, nederlands TDF, BE tdf, tdf, NL tdf, dutch fellowship, fellowship, the dutch fellowship,the dutch guild, alliance, alliance gw2, gw2 dutch fellowship, dutch fellowship guild, nederlandse alliance, guild in guild wars 2');
	$this->setTitle(' Welkom! ');
	
  }
  
  
  public function executeRules(sfWebRequest $request)
  {
		/* Tags Cloud */
		$tags = array();
		$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
		foreach ($blogsTags as $blog) {
			foreach ($blog->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		$imageTags = Doctrine::getTable('Image')->getAll();
		foreach ($imageTags as $image) {
			foreach ($image->Tags as $tag) {
				if(isset($tags[$tag->id]['count'])) {
					$tags[$tag->id]['count'] = $tags[$tag->id]['count']+1;
				} else {
					$tags[$tag->id]['count'] = 1;
					$tags[$tag->id]['tag'] = $tag;
				}
			}
		}
		// Send tags array to template
		shuffle($tags); 
		$this->tags = $tags;
		
		
	// SET META
	$this->getResponse()->addMeta('description', 'Regels van The Dutch Fellowship.');
	$this->getResponse()->addMeta('keywords', 'homepage, home, pagina,  page, dutch, nederlands, guild, Nederland, NL, BE, NL/BE, belgisch, nederlandse guild, belgische guild, guild wars 2, casual, pve, pvp, WvW, WvWvW, recruiting, grote guild, kleine guild, gezellige guild, professionele guild, non-profit, games, game, gamers, begin pagina, begin, aanmelden, apply, release date, release date guild wars 2, guild wars, gw2, gw2 guild, dutch gw2 guild, dutch gw2, belgische gw2, belgische gw2 guild, onze regels, regels, guild regels');
	$this->setTitle(' Regels ');
	
  }
  
  
  public function executeImportant() {
  
	setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if($isLoggedIn) {
		$this->userLogged = $login->getLoggedUser();
		$this->forward404Unless($this->userLogged->Permission->level > 1);
	}  else {
		$this->forward404();
	}
  }
  
  public function execute404(sfWebRequest $request)
  {
	// SET META
	$this->getResponse()->addMeta('description', '404');
	$this->setTitle(' 404 ');
	
  }
}
