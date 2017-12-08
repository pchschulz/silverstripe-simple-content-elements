<?php
class SCEImage extends SCEBase {

  private static $singular_name = 'Bildelement';
  private static $plural_name = 'Bildelemente';

  private static $db = [
  	'Lightbox' => 'Boolean',
	  'ImageHeight' => 'Int',
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
	  return $requiredFields;
  }

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
	  	UploadField::create('Image', 'Bild')
		    ->setFolderName('images')
		    ->setDisplayFolderName('images'),
		  NumericField::create('ImageHeight', 'Höhe des Bilds')
		    ->setDescription('Wird nur benötigt wenn Sie vom Standardformat abweichen wollen. Dieses beträgt 16:9'),
		  DropdownField::create('Lightbox', 'In der Lightbox öffnen', [1 => 'Ja', 0 => 'Nein'], 1),
	  ]);

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}