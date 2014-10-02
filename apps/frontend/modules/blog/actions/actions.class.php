<?php

/**
 * blog actions.
 *
 * @package    tdf
 * @subpackage blog
 * @author     Olmo Buining
 */
class blogActions extends myActions
{
	/**
	* Executes index action
	*
	* @param sfRequest $request A request object
	*/
	public function executeItem(sfWebRequest $request)
	{
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));
		$type = $request->getParameter('type');
		$slug = $request->getParameter('slug');
		$this->blog = Doctrine::getTable('Post')->findOneBySlug($slug);
		
		$this->relatedBlogs = $this->blog->getRelatedBlogs();
		
		$this->mainImage = $this->blog->getMainImage();
		if($this->mainImage === false) {
			$this->mainImage = array();	
		}
		$this->subImages = $this->blog->getSubImages();
		
		
		$login = new LoginClass();
		$this->isLoggedIn = $login->check();
		if ($this->isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}
		
		$this->forward404Unless($this->blog);
		$this->forward404Unless($type == $this->blog->PostType->slug);	
		// SET META
		$this->getResponse()->addMeta('description', $this->blog->PostType->name.' blog: '.$this->blog->title.' - '.strip_tags(substr($this->blog->text, 0 , 80)));
		$this->setTitle($this->blog->PostType->name.': '.$this->blog->title);
		sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
		// Set Social media slot
		$this->getResponse()->setSlot('socialmediaHeader', 
		'
		<meta property="og:title" content="'.$this->blog->title.'" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="http://guild-tdf.nl/'.url_for('blog_item', array('type' => 'news', 'slug' => $this->blog->slug)).'" />
		<meta property="og:image" content="http://guild-tdf.nl/images/logo.jpg" />
		<meta property="og:site_name" content="The Dutch Fellowship" />
		<meta property="fb:admins" content="718198926" />
		'
		);
		$this->type = $type;
	}
	
	
	public function executeIndex(sfWebRequest $request) {
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
		// SET META
		$this->getResponse()->addMeta('description', 'Alle nieuws berichten van The Dutch Fellowship');
		$this->setTitle('Nieuws blog ');
		
		$this->charLogReq = sfConfig::get('app_permissions_see_char_log');
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
		}
		$next = false;
		$prev = false;
		$type = $request->getParameter('type');
		$page = $request->getParameter('page');
			
		if ($type == 'news') {
			if((isset($page)) && (is_numeric($page))) {
				$this->blogs = Doctrine::getTable('Post')->getAllPostsByType('1', $page*5);
			} else {
				$this->blogs = Doctrine::getTable('Post')->getAllPostsByType('1');
			}
			$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('1', 0 , 0);
			$this->forward404unless(count($this->blogs) != 0);
		}elseif($type == 'beginners') {
			if((isset($page)) && (is_numeric($page))) {
				$this->blogs = Doctrine::getTable('Post')->getAllPostsByType('2', $page*5);
			} else {
				$this->blogs = Doctrine::getTable('Post')->getAllPostsByType('2');
			}
			$blogsTags = Doctrine::getTable('Post')->getAllPostsByType('2', 0 , 0);
			$this->forward404unless(count($this->blogs) != 0);
			
			
		}else {
			$this->forward404();	
		}
		$this->postType = Doctrine::getTable('PostType')->findOneBySlug($type);
		$totalBlogs = count($blogsTags);
		if((isset($page)) && (is_numeric($page))&& ($page != 0)) {
			if ($totalBlogs > (($page+1)*5)) {
				$next = true;
			}
		} else {
			if ($totalBlogs > 5) {
				$next = true;
			}
		}
		if (isset($page)) {
			if ($page > 0) {
				$prev = true;
			}
		} else {
			$page = 0;	
		}
		$this->page = $page;
		$this->prev = $prev;
		$this->next = $next;
		$this->type = $type;
		
		
		/* Tags Cloud */
		$tags = array();
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
		// Send tags array to template
		shuffle($tags);
		$this->tags = $tags;
		
	}
}
