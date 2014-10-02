<?php

/**
 * backend actions.
 *
 * @package    tdf
 * @subpackage backend
 * @author     Olmo Buining
 */
class backendActions extends myActions	{
	
	public function executeAdminLog(sfWebRequest $request)
	{
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_see_admin_log'));
			$this->logs = Doctrine::getTable('AdminLog')->getLast(250);
			$this->extras = Doctrine::getTable('Extra')->OnlineUsers();
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	public function executeActivityCheck(sfWebRequest $request)
	{
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_see_admin_log'));
			$this->users = Doctrine::getTable('User')->getAll();
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	public function executeStatistics(sfWebRequest $request) {
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_see_admin_log'));
			
			$this->form = new searchmyCharactersForm();
			
			
			if ($request->isMethod('post')) {
				$parameters = $request->getParameter('searchChars');
				
				$this->characters = Doctrine::getTable('myCharacter')->search($parameters);
				$this->form->bind($parameters);
			} else {
				$this->characters = Doctrine::getTable('myCharacter')->search($parameters);
			}
			$this->newChars = Doctrine::getTable('myCharacterLog')->getLastNewCharacters(40);
			$profs = array();
			$races = array();
			
			foreach($this->characters as $char) {
				if(isset($profs[$char->Profession->name])) {
					$profs[$char->Profession->name] = $profs[$char->Profession->name] + 1;
				} else { 
					$profs[$char->Profession->name] = 1;
				}
				if(isset($races[$char->Race->name])) {
					$races[$char->Race->name] = $races[$char->Race->name] + 1;
				} else { 
					$races[$char->Race->name] = 1;
				}
			}
			$this->races = $races;
			$this->profs = $profs;
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeNewChars(sfWebRequest $request) {
		setlocale(LC_ALL, array('nl_NL', 'nl_NL.UTF-8', 'nl_NL.ISO-8859-1'));	
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_see_admin_log'));
			$this->newChars = Doctrine::getTable('myCharacterLog')->getLastNewCharacters(40);
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	public function executeImageUpload(sfWebRequest $request){
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_image_new'));
			$this->form = new ImageUploadForm();
			if ($request->isMethod('post')) {
				$parameters = $request->getParameter('imageUpload');
				
				$this->form->bind($parameters, $request->getFiles($this->form->getName()));
				if($this->form->isValid()){
					$file = $this->form->getValue('file');
					$filename = $file->getOriginalName();
					$file->save('/home/id514/domains/guild-tdf.nl/public_html/web/uploads/images/'.$filename);
					$resizing = new resizeImage();
					$resizing->resizeToAll($filename, md5(time()), $this->form->getValue('title'), $this->form->getValue('text'), $this->userLogged->id);
					// echo 'goed';
					$messageToLog = 'Het plaatje is geupload!';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Uploaded image door :". $this->userLogged->username;
					$adminlog->save();
					$this->getUser()->setAttribute('errorMessage', $messageToLog);
					sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
					$this->redirect(url_for('new-image'));
				} else {
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	
	public function executeEditBlog(sfWebRequest $request){
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_edit_blogs'));
			$id = $request->getParameter('id');
			$blog = Doctrine::getTable('Post')->findOneById($id);
			$this->forward404Unless($blog);
			$this->form = new PostForm();
			$this->form->setDefaults(
				array(
					'title' => $blog->title
					,'text' => $blog->text
				)
			);
			
			if ($request->isMethod('post')) {
				
				$parameters = $request->getParameter('post');
				$parameters['user_id'] = $blog->User->id;
				$parameters['post_type_id'] = $blog->post_type_id;
				$parameters['created_at'] = $blog->created_at;
				
				$this->form->bind($parameters);
				if($this->form->isValid()){
					$blog->title = $this->form->getValue('title');
					$blog->text = $this->form->getValue('text');
					$blog->save();
					$messageToLog = 'De blog is aangepast!';
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "editted blog: $blog->title | door: ".$login->getLoggedUser()->username;
					$adminlog->save();
					$this->getUser()->setAttribute('errorMessage', $messageToLog);
					sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
					$this->redirect(url_for('blog_item', array('type' => $blog->PostType->slug , 'slug' => $blog->slug)));
				}
			}
			$this->blog	= $blog;
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
			
	}
	
	public function executeActivateUser(sfWebRequest $request)
	{
		$this->message = "";
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->forward404Unless($this->userLogged->Permission->level > sfConfig::get('app_permissions_activate_users'));
			$this->users = Doctrine::getTable('User')->getInactiveUsers();
			
			if ($request->isMethod('post')) {
				$id = $request->getPostParameter('user');
				$user = Doctrine::getTable('User')->findOneById($id);
				$this->forward404Unless($user);
				$user->permission_id = 2;
				$user->rank_id = 8;
				$user->save();
				$this->message = "$user->username is geactiveerd!";
				$to = $user->email;
				try {
					$mailer = $this->getMailer();
					$this->getMailer()->composeAndSend(
						  'info@guild-tdf.nl',
						  $to,
						  'TDF - Registratie website',
"Uw account is zojuist geactiveerd door een van onze admins. U kunt nu inloggen met gebruikersnaam: $user->username.
!Let op! Deze account staat los van het forum en heeft een andere inlog. Je kunt inloggen op http://www.guild-tdf.nl/login
Na het inloggen kun je karakters toevoegen aan je account om zo in de toekomst je aan te kunnen melden bij een evenement.

Nog vragen? neem dan contact op met een van de leiders of andere leden. Ook kun je altijd emailen naar: info@guild-tdf.nl

Met vriendelijke groet,

The Dutch Fellowship.
www.guild-tdf.nl"
						);
				} catch (Exception $e) {
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Mail voor het activeren werkte niet:".$user->username." | Error: ".$e->getMessage();
					$adminlog->save();
				}
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = $this->message;
				$adminlog->save();
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeRoster(sfWebRequest $request)
	{
		$this->leaders = Doctrine::getTable('User')->getLeaders();
		$this->veterans = Doctrine::getTable('User')->getVeterans();
		$this->pvxs = Doctrine::getTable('User')->getPvxs();
		$this->pvps = Doctrine::getTable('User')->getPvps();
		$this->pves = Doctrine::getTable('User')->getPves();
		$this->wvws = Doctrine::getTable('User')->getWvws();
		$this->interns = Doctrine::getTable('User')->getInterns();
		
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		$this->userIsLogged = false;
		if($isLoggedIn) {
			$this->userIsLogged = true;
			$this->userLogged = $login->getLoggedUser();
		}
	}
	
	
	public function executeIndex(sfWebRequest $request)
	{
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$this->ts3token = $this->userLogged->getTS3Token();
			$this->maxchars = sfConfig::get('app_character_maxcharacters');
			$this->tagReq = sfConfig::get('app_permissions_tag');
			$this->blogReq = sfConfig::get('app_permissions_blog');
			$this->newEventReq = sfConfig::get('app_event_new');
			$this->registrationDate = $this->userLogged->getRegistrationDate();
			$comments = array();
			$i = 0;
			foreach ($this->userLogged->Comments as $comment) {
				array_push($comments, $comment);
				rsort($comments);
				$i++;
				if ($i == 15) {
					break;	
				}
			}
			$this->comments = $comments;
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeSingleInput(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$permissionReq = sfConfig::get('app_permissions_change_username');
			if ($this->userLogged->Permission->level > $permissionReq) {
				$valid = false;
				$editOrNew = '';
				$name = '';
				
				$what = $request->getParameter('what');
				$this->what = $what;
				$id = $request->getParameter('id');
				$this->id = $id;
				$this->form = new singleInputForm();
				
				if ($request->isMethod('post')) {
					$parameters = $request->getParameter('singleInput');
					
					$this->form->bind($parameters);
					if($this->form->isValid()){
						$valid = true;
						$input = $this->form->getValue('singleInput');
					}
				}
				
				
				/*********** USERNAME CHANGE *************/
				if ($what == 'username') {
					$name = 'Gebruikersnaam';
					$editOrNew = 'aanpassen';
					$this->form->setDefaults(
						array(
							'singleInput' => $this->userLogged->username
						)
					);
					if($valid === true){
						$adminlog = new AdminLog();
						$adminlog->created_at = time();
						$adminlog->description = "username veranderd naar:".$input ." | door: ".$this->userLogged->username;
						$adminlog->save();
						$this->userLogged->username = $input;
						$this->userLogged->save();
						$this->getUser()->setAttribute('errorMessage', "Je gebruikersnaam is veranderd in ". $this->userLogged->username.". Je kunt nu met je nieuwe gebruikersnaam inloggen.");
						sfContext::getInstance()->getConfiguration()->loadHelpers( 'Url' );
						$this->redirect(url_for('logout'));
					}
				}
				/********** END USERNAME CHANGE   **************/
				
				
				
				
				
				
				$this->editOrNew = $editOrNew;
				$this->name = $name;
				
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());	
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeUser(sfWebRequest $request)
	{
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$slug = $request->getParameter('slug');
			$user = Doctrine::getTable('User')->findOneBySlug($slug);
			$this->forward404Unless($user);
			$this->registrationDate = $user->getRegistrationDate();
			// Redirect if this is you're own account
			if ($user->id == $this->userLogged->id) {
				$this->redirect('/my-account');
			}
			
			$comments = array();
			$i = 0;
			foreach ($user->Comments as $comment) {
				array_push($comments, $comment);
				rsort($comments);
				$i++;
				if ($i == 15) {
					break;	
				}
			}
			$this->user = $user;
			$this->comments = $comments;
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeNewTag(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$permissionReq = sfConfig::get('app_permissions_tag');
			if ($this->userLogged->Permission->level > $permissionReq['new']) {
				$form = new addTagForm();
				$form->getCSRFToken();
				if ($request->isMethod('post')) {
					$form->bind($request->getParameter('addTag'));
					if ($form->isValid()) {
						if ($findTag = Doctrine::getTable('Tag')->findOneByName($form->getValue('tag'))) {
							$this->message = 'De tag "'.$findTag->name.'" bestaat al.';
						} else {
							$tag = new Tag();
							$tag->name = $form->getValue('tag');
							$this->message = 'Tag: '.$tag->name.' is opgeslagen.';
							$tag->save();
							$adminlog = new AdminLog();
							$adminlog->created_at = time();
							$adminlog->description = 'nieuw tag:'. $tag->name. '. Door: '. $this->userLogged->username;
							$adminlog->save();
						}
						
					} else {
						//var_dump('Debug form false');	
					}
				}
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());	
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
		$this->form = $form;
	}
	
	
	public function executeAttachTag(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$permissionReq = sfConfig::get('app_permissions_tag');
			if ($this->userLogged->Permission->level > $permissionReq['attach_all']) {
				$this->blogs = Doctrine::getTable('Post')->getAll(0,'id DESC');
				$tableTags = Doctrine::getTable('Tag')->getAll();
			} elseif ($this->userLogged->Permission->level > $permissionReq['attach']) {
				$this->blogs = $this->userLogged->Posts;
				$tableTags = Doctrine::getTable('Tag')->getAll();
			}
			
			$tags = array();
			foreach($tableTags as $tag ) {
				$tags[$tag->id] = $tag->name;
			}
			asort($tags);
			$this->tags = $tags;
			/*
			if ($request->isMethod('post')) {
				$linkTag = new postTag();
				$linkTag->post_id = $request->getPostParameter('post');
				$linkTag->tag_id = $request->getPostParameter('tag');
				if (!$linkTag->checkLink()) {
					$linkTag->save();
					$tagName = Doctrine::getTable('Tag')->findOneById($request->getPostParameter('tag'))->name;
					$blogName = Doctrine::getTable('Post')->findOneById($request->getPostParameter('post'))->title;
					$this->message = 'Tag '. $tagName.' is gelinkt met Blog: ' .$blogName ;	
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $this->message;
					$adminlog->save();
				} else {
					$this->message = 'Deze blog heeft de gekozen tag al.';
				}
			}*/
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeAttachTagImage(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$permissionReq = sfConfig::get('app_permissions_tag');
			if ($this->userLogged->Permission->level > sfConfig::get('app_image_new')) {
				$this->images = Doctrine::getTable('Image')->getAll(0,'id DESC');
				$tableTags = Doctrine::getTable('Tag')->getAll();
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
			}
			
			$tags = array();
			foreach($tableTags as $tag ) {
				$tags[$tag->id] = $tag->name;
			}
			asort($tags);
			$this->tags = $tags;
			/*
			if ($request->isMethod('post')) {
				$linkTag = new imageTag();
				$linkTag->image_id = $request->getPostParameter('image');
				$linkTag->tag_id = $request->getPostParameter('tag');
				if (!$linkTag->checkLink()) {
					$linkTag->save();
					$tagName = Doctrine::getTable('Tag')->findOneById($request->getPostParameter('tag'))->name;
					$imageName = Doctrine::getTable('Image')->findOneById($request->getPostParameter('image'))->title;
					$this->message = 'Tag '. $tagName.' is gelinkt met Image: ' .$imageName ;	
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $this->message;
					$adminlog->save();
				} else {
					$this->message = 'Deze Image heeft de gekozen tag al.';
				}
			}*/
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeAjaxAttachTag(sfWebRequest $request)
	{
		$this->setLayout(false);
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$permissionReq = sfConfig::get('app_permissions_tag');
			$this->forward404Unless($this->userLogged->Permission->level > $permissionReq['attach_all']);
			$tag_id = $request->getParameter('tagid');
			
			$to = $request->getParameter('to');
			if ($to == 'image') {
				$image_id = $request->getParameter('imageid');
				$name = Doctrine::getTable('Image')->findOneById($image_id)->title;
				$linkTag = new imageTag();
				$linkTag->image_id = $image_id;
			} elseif ($to == 'blog') {
				$blog_id = $request->getParameter('blogid');
				$name = Doctrine::getTable('Post')->findOneById($blog_id)->title;
				$linkTag = new postTag();
				$linkTag->post_id = $blog_id;
			}
			$linkTag->tag_id = $tag_id;
			$tag = Doctrine::getTable('Tag')->findOneById($tag_id)->name;
			if (!$linkTag->checkLink()) {
				$linkTag->save();
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = "Tag: ".$tag. " op ".$to." : ".$name;
				$adminlog->save();
				echo json_encode(array('status' => 'new'));
			} else {
				if($to == 'image') {
					$link = Doctrine::getTable('imageTag')->getLink($tag_id, $image_id);
					$link->delete();
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Deleted Tag: ".$tag. " op ".$to." : ".$name;
					$adminlog->save();
					echo json_encode(array('status' => 'removed'));
				} elseif($to == 'blog') {
					$link = Doctrine::getTable('postTag')->getLink($tag_id, $blog_id);
					$link->delete();
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = "Deleted Tag: ".$tag. " op ".$to." : ".$name;
					$adminlog->save();
					echo json_encode(array('status' => 'removed'));
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
	
	public function executeAjaxGetTags(sfWebRequest $request)
	{
		$this->setLayout(false);
		
		$for = $request->getParameter('for');
		if ($for == 'image') {
			$image_id = $request->getParameter('imageid');
			$tableTags = Doctrine::getTable('imageTag')->getTagsWithImageId($image_id);
		} if ($for == 'blog') {
			$blog_id = $request->getParameter('blogid');
			$tableTags = Doctrine::getTable('PostTag')->getTagsWithBlogId($blog_id);
		}
		//var_dump(count($imageTags));
		$tags = array();
		foreach ($tableTags as $tag ) {
			$tags[$tag->id] = $tag->name;
		}
		
		echo json_encode($tags);
	}
	
	
	public function executeAttachImageType(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged->Permission->level > sfConfig::get('app_image_new')) {
				$this->images = Doctrine::getTable('Image')->getAll(0, 'id DESC');
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
			}
			if ($request->isMethod('post')) {
				$linkTag = new imageImageType();
				$linkTag->image_id = $request->getPostParameter('image');
				$linkTag->image_type_id = $request->getPostParameter('type');
				if (!$linkTag->checkLink()) {
					$this->message = 'Image Type is gelinkt met het plaatje ';	
					$linkTag->save();
				} else {
					$this->message = 'Deze Image heeft de gekozen tag al.';
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeAttachImageAlbum(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged->Permission->level > sfConfig::get('app_image_new')) {
				$this->images = Doctrine::getTable('Image')->getAll(0,'id DESC');
				$this->albums = Doctrine::getTable('Album')->getAll();
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
			}
			if ($request->isMethod('post')) {
				$linkTag = new ImageAlbum();
				$linkTag->image_id = $request->getPostParameter('image');
				$linkTag->album_id = $request->getPostParameter('album');
				if (!$linkTag->checkLink()) {
					$linkTag->save();
					$albumName = Doctrine::getTable('Album')->findOneById($request->getPostParameter('album'))->name;
					$imageName = Doctrine::getTable('Image')->findOneById($request->getPostParameter('image'))->title;
					$this->message = 'Album '. $albumName.' is gelinkt met Image: ' .$imageName ;	
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $this->message;
					$adminlog->save();
				} else {
					$this->message = 'Deze Image heeft de gekozen Album al.';
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	
	public function executeAttachImageBlog(sfWebRequest $request)
	{
		$this->message = '';
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged->Permission->level > sfConfig::get('app_image_new')) {
				$this->blogs = Doctrine::getTable('Post')->getLastPostsByType(1);
				$this->images = Doctrine::getTable('Image')->getAll();
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
			}
			if ($request->isMethod('post')) {
				$linkTag = new PostImage();
				$linkTag->post_id = $request->getPostParameter('post');
				$linkTag->image_id = $request->getPostParameter('image');
				if (!$linkTag->checkLink()) {
					$linkTag->save();
					$imageName = Doctrine::getTable('Image')->findOneById($request->getPostParameter('image'))->name;
					$blogName = Doctrine::getTable('Post')->findOneById($request->getPostParameter('post'))->title;
					$this->message = 'Image '. $imageName.' is gelinkt met Blog: ' .$blogName ;	
					$adminlog = new AdminLog();
					$adminlog->created_at = time();
					$adminlog->description = $this->message;
					$adminlog->save();
				} else {
					$this->message = 'Deze blog heeft de gekozen Image al.';
				}
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
		
	}
	
	/* AJAX call to level character */
	public function executeLevelCharacter(sfWebRequest $request) {
		$this->setLayout(false);
		$id = $request->getParameter('id');
		$action = $request->getParameter('doWhat');
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		$messageToLog = "";
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			$editReq = sfConfig::get('app_permissions_character');
			$character = Doctrine::getTable('myCharacter')->findOneById($id);
			$messageToLog .= "character id: ".$id." - ".$character->name." \n";
			if(($this->userLogged->Permission->level > $editReq['edit_all']) || ($this->userLogged->id == $character->User->id)) {
				$maxlevel = sfConfig::get('app_character_maxlevel');
				$minlevel = sfConfig::get('app_character_minlevel');
				if($action == 'up') {
					$messageToLog .= "level up \n";
					if ($character->level != $maxlevel) {
						$character->level = $character->level + 1;
						$messageToLog .= "to level ".$character->level." \n";
						echo json_encode(array('error' => false, 'newLevel' => $character->level));
					} else {
						$messageToLog .= "At Max Level \n";
						echo json_encode(array('error' => true, 'message' => 'Max. level is '.$maxlevel));
					}
				} elseif ($action == 'down') {
					$messageToLog .= "level down \n";
					if ($character->level != $minlevel ) {
						$character->level = $character->level - 1;
						$messageToLog .= "to level ".$character->level." \n";
						echo json_encode(array('error' => false, 'newLevel' => $character->level));
					} else {
						$messageToLog .= "At Min Level \n";
						echo json_encode(array('error' => true, 'message' => 'Min. level is '.$minlevel));
					}
				} else {
					$messageToLog .= "no valid action given \n";
					echo json_encode(array('error' => true, 'message' => 'No valid action'));
				}
				$character->save();
				/*$milstones = sfConfig::get('app_character_milstones');
				if(in_array($character->level, $milstones)){*/
					$lastLog = Doctrine::getTable('myCharacterLog')->getLastLog();
					if ($lastLog->mycharacter_id != $character->id) {
						$charlog = new myCharacterLog();
						$charlog->mycharacter_id = $character->id;
						$charlog->mycharacter_type_id = 2;
						$charlog->description = $character->level;
						$charlog->created_at = time();
						$charlog->save();
					} else {
						$lastLog->description = $character->level;
						$lastLog->created_at = time();
						$lastLog->save();
					}
				// }
				$this->getUser()->setAttribute('pushEvent', array('Karakter', 'Level '.$action, $character->name, $character->level));
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = $messageToLog;
				$adminlog->save();
				
			} else {
				echo json_encode(array('error' => true, 'message' => 'Niet genoeg rechten of niet jou character'));	
			}
		} else {
			echo json_encode(array('error' => true, 'message' => 'Niet ingelogd'));		
		}
	}
}
