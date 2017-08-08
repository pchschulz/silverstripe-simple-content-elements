<?php
class SCETextImageElement extends SCEElement {

  private static $singular_name = 'Text & Bild-Element';
  private static $plural_name = 'Text & Bild-Elemente';

  private static $db = [
    'Content' => 'HTMLText',
	  'ImagePosition' => 'Varchar(10)',
  ];

  private static $has_one = [
    'Image' => 'Image',
  ];

  private static $summary_fields = [
    'Image.CMSThumbnail' => 'Bild',
  ];

	public function getCMSValidator() {
		$requiredFields = parent::getCMSValidator();
		$requiredFields->addRequiredField('Image');
		$requiredFields->addRequiredField('Content');
		$requiredFields->addRequiredField('ImagePosition');
		return $requiredFields;
	}

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
		  HtmlEditorField::create('Content', 'Inhalt'),
	  	UploadField::create('Image', 'Bild')
		    ->setFolderName('sce')
		    ->setDisplayFolderName('sce'),
		  DropdownField::create('ImagePosition', 'Position des Bildes', [
		  	'left' => 'Links',
			  'right' => 'Rechts',
		  ])
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}