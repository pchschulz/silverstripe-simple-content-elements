<?php
class SCEImage extends SCEBase {

  private static $singular_name = 'Bildelement';
  private static $plural_name = 'Bildelemente';

  private static $has_one = [
    'Image' => 'Image',
  ];

	private static $summary_fields = [
		'Image.CMSThumbnail' => 'Bild',
	];

  public function getCMSValidator() {
	  $requiredFields = parent::getCMSValidator();
	  $requiredFields->addRequiredField('Image');
	  return $requiredFields;
  }

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
	  	UploadField::create('Image', 'Bild')
		    ->setFolderName('sce')
		    ->setDisplayFolderName('sce')
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}