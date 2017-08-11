<?php
class SCEText extends SCEBase {

  private static $singular_name = 'Textelement';
  private static $plural_name = 'Textelemente';
  
  private static $db = [
    'Content' => 'HTMLText',
	  'CodeLanguage' => 'Varchar(255)',
  ];

	public function getCMSValidator() {
		$requiredFields = parent::getCMSValidator();
		$requiredFields->addRequiredField('Content');
		return $requiredFields;
	}

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
	  	DropdownField::create('CodeLanguage', 'Code-Snippet', [
			  'php' => 'PHP',
			  'html' => 'HTML',
			  'c++' => 'C++',
		  ])->setEmptyString(' '),
	    HtmlEditorField::create('Content', 'Inhalt'),
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}