<?php
class SCETextImage extends SCEBase {

  private static $singular_name = 'Text & Bild-Element';
  private static $plural_name = 'Text & Bild-Elemente';

  private static $db = [
    'Content' => 'HTMLText',
	  'ImagePosition' => 'Varchar(10)',
	  'Lightbox' => 'Boolean',
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
		  UploadField::create('Image', 'Bild')
			  ->setFolderName('images')
			  ->setDisplayFolderName('images'),
		  DropdownField::create('ImagePosition', 'Position des Bildes', [
			  'left' => 'Links',
			  'right' => 'Rechts',
		  ]),
		  DropdownField::create('Lightbox', 'In der Lightbox öffnen', [1 => 'Ja', 0 => 'Nein'], 1),
		  HtmlEditorField::create('Content', 'Inhalt'),
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}