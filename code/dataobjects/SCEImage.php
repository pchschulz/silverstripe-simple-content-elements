<?php
class SCEImage extends SCEBase {

  private static $singular_name = 'Bildelement';
  private static $plural_name = 'Bildelemente';

  private static $db = [
	  'LightboxOrLink' => 'Varchar(25)',
	  'ImageHeight' => 'Int',
	  'Link' => 'NamedLinkField',
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
		  DropdownField::create('LightboxOrLink', 'Aktion', [
			  'lightbox' => 'Lightbox',
			  'link' => 'Link'
		  ], 'lightbox')->setEmptyString('(keine)'),
		  $linkField = DisplayLogicWrapper::create(NamedLinkFormField::create('Link', 'Link'))->setName('LinkWrapper'),
	  	UploadField::create('Image', 'Bild')
		    ->setFolderName('images')
		    ->setDisplayFolderName('images'),
		  NumericField::create('ImageHeight', 'Höhe des Bilds')
		    ->setDescription('Wird nur benötigt wenn Sie vom Standardformat abweichen wollen. Dieses beträgt 16:9'),
	  ]);

	  $linkField->displayIf('LightboxOrLink')->isEqualTo('link');

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}