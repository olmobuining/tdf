<?php

/**
 * postForm actions.
 *
 * @package    tdf
 * @subpackage postForm
 * @author     Olmo Buining
 */
class postFormActions extends myActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->forward404();
		$this->posts = Doctrine_Core::getTable('Post')
			->createQuery('a')
			->execute();
	  }

	public function executeShow(sfWebRequest $request) {
		$this->forward404();
		$this->post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->post);
	}

	public function executeNew(sfWebRequest $request) {
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged->Permission->level >= 49) {
				$this->form = new PostForm();
				$this->type = $request->getParameter('type');
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
			}
		}
	}

	public function executeCreate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST));
	
		$this->form = new PostForm();
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($this->userLogged->Permission->level >= 49) {
				$parameters = $request->getParameter('post');
				$parameters['user_id'] = $this->userLogged->id;
				$type = $request->getParameter('type');
				$this->type = $type;
				if ($type == 'news') {
					$parameters['post_type_id'] = 1;
				} elseif($type == 'beginners') {
					$parameters['post_type_id'] = 2;
				}
				$parameters['created_at'] = time();
				
				$this->form->bind($parameters);
				$this->processForm($request, $this->form, $type);
			} else {
				$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());	
			}
		}
		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)  {
		$this->forward404();
		$this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
		$this->form = new PostForm($post);
	}

	public function executeUpdate(sfWebRequest $request) {
		$this->forward404();
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
		$this->form = new PostForm($post);
		
		$this->processForm($request, $this->form);
		
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request) {
		$this->forward404();
		$request->checkCSRFProtection();
		
		$this->forward404Unless($post = Doctrine_Core::getTable('Post')->find(array($request->getParameter('id'))), sprintf('Object post does not exist (%s).', $request->getParameter('id')));
		$post->delete();
		
		$this->redirect('postForm/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form, $type='news') {
		$login = new LoginClass();
		$isLoggedIn = $login->check();
		if($isLoggedIn) {
			$this->userLogged = $login->getLoggedUser();
			if ($form->isValid()) {
				$parameters = $request->getParameter($form->getName());
				if(empty($parameters['user_id'])) {
					$parameters['user_id'] = $this->userLogged->id;
				}
				if ($type == 'news') {
					$parameters['post_type_id'] = 1;
				} elseif($type == 'beginners') {
					$parameters['post_type_id'] = 2;
				}
				if(empty($parameters['created_at'])) {
					$parameters['created_at'] = time();
				} else {
					$parameters['updated_at'] = time();
				}
				$form->bind($parameters);
				$post = $form->save();
				$this->redirect('/');
			}
		} else {
			$this->redirect('@login?url='.sfContext::getInstance()->getRouting()->getCurrentInternalUri());
		}
	}
}
