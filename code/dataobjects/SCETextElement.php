<?php
class SCETextElement extends SCEElement {

  private static $singular_name = 'Textelement';
  private static $plural_name = 'Textelemente';
  
  private static $db = [
    'Content' => 'HTMLText',
  ];

	public function getCMSValidator() {
		$requiredFields = parent::getCMSValidator();
		$requiredFields->addRequiredField('Content');
		return $requiredFields;
	}

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
	    HtmlEditorField::create('Content', 'Inhalt')
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}