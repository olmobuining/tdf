<?php

/**
 * comment actions.
 *
 * @package    tdf
 * @subpackage comment
 * @author     Olmo Buining
 */
class commentActions extends myActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executePostComment(sfWebRequest $request)
  {
	$this->setLayout(false);
	$get = $this->getRequestParameter('submit');
	$postid = $this->getRequestParameter('postid');
	$imageid = $this->getRequestParameter('imageid');
	$login = new LoginClass();
	$isLoggedIn = $login->check();
	if(!$isLoggedIn) {
		echo 'login om een reacties te plaatsen';
	} else {
		$userLogged = $login->getLoggedUser();
		if ($get != '') {
			$form = new CommentForm();
			$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
			$parameters = $request->getParameter($form->getName());
			$parameters['user_id'] = $userLogged->id;
			$parameters['text'] = $get;
			if (isset($postid)) {
				$parameters['post_id'] = $postid;
				$blog = Doctrine::getTable('Post')->findOneById($postid);
				$this->name = $blog->title;
			}
			if (isset($imageid)) {
				$parameters['image_id'] = $imageid;
				$image = Doctrine::getTable('Image')->findOneById($imageid);
				$this->name = $image->title;
			}
			$parameters['created_at'] = time();
			//$parameters['_csrf_token'] = 'c5190986e2a7f228d57b0196198ea9f1';
			$form->bind($parameters);
			//$request->checkCSRFProtection();
			$comment = $form->save();
			if ($comment) {
				echo 'Je reactie is geplaatst.';
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = 'reactie geplaats op p:"'. $postid . '" i: "'. $imageid.'" | door: '. $userLogged->username;
				$adminlog->save();
			} else {
				echo 'Reactie plaatsen is mislukt.';	
				$adminlog = new AdminLog();
				$adminlog->created_at = time();
				$adminlog->description = 'reactie mislukt op post:"'. $postid . '"of image: "'. $imageid.'" | door: '. $userLogged->username;
				$adminlog->save();
			}
			
		}
	}
  }
}
