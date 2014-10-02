<?php

class imageUploadForm extends BaseForm {
	
	public function configure() {
		
		$this->setWidgets(array(
			'title'    => new sfWidgetFormInputText(),
			'text' => new sfWidgetFormTextarea(),
			'file' => new sfWidgetFormInputFile()
		));
		
		$this->setValidators(array(
		  'title' => new sfValidatorString( 
						array('required' => true), array('min_length' => 1)),
		  'text' => new sfValidatorString( 
						array('required' => true), array('min_length' => 10)),
		  'file' => new sfValidatorFile(array('max_size' => 50000000,
										'mime_types' => 'web_images',
										'path' => '/home/id514/domains/guild-tdf.nl/public_html/web/uploads/images/'))
		));
		$this->widgetSchema->setNameFormat("imageUpload[%s]");
	}
}
?>