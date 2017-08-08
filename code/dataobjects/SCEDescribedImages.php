<?php
class SCEDescribedImages extends SCEBase {

  private static $singular_name = 'Bilder mit Beschreibung';
  private static $plural_name = 'Bilder mit Beschreibung';

  private static $db = [
    'ImagesPerRow' => 'Int',
	  'Lightbox' => 'Boolean',
  ];

	private static $has_many = [
		'Images' => 'SCEDescribedImages_Image',
	];

	public function getCMSValidator() {
	  $requiredFields = parent::getCMSValidator();
	  $requiredFields->addRequiredField('Images');
	  return $requiredFields;
	}

	public function getCMSFields() {
	  $fields = parent::getCMSFields();
	  $fields->addFieldsToTab('Root.Main', [
	  	DropdownField::create('ImagesPerRow', 'Bilder pro Reihe', [
	  		2 => 2,
			  3 => 3,
		  ]),
		  DropdownField::create('Lightbox', 'In der Lightbox öffnen', [1 => 'Ja', 0 => 'Nein'], 1),
		  GridField::create('Images', 'Bilder', $this->Images(), SCEGridConfig::create(30, 'SortOrder')),
		  LiteralField::create('SaveNotice', '<div class="message notice">Nach dem Speichern können Bilder hinzugefügt werden.</div>')
	  ]);

	  if(!$this->ID) {
	  	$fields->removeByName('Images');
	  } else {
	  	$fields->removeByName('SaveNotice');
	  }

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}

	public function ExtraHeaderClass() {
		return $this->ClassNameForTemplate(true) . '--num' . $this->ImagesPerRow;
	}
}