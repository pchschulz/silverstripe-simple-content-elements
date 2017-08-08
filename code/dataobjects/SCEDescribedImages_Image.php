<?php
class SCEDescribedImages_Image extends DataObject {

  private static $singular_name = 'Bild';
  private static $plural_name = 'Bilder';

  private static $db = [
  	'Content' => 'HTMLText',
	  'SortOrder' => 'Int',
  ];

  private static $has_one = [
    'Image' => 'Image',
	  'Element' => 'SCEDescribedImages',
  ];
  
  private static $summary_fields = [
    'Image.CMSThumbnail' => 'Bild',
	  'Content.Summary' => 'Beschreibung',
  ];
  
  private static $default_sort = 'SortOrder';
  
  public function getCMSValidator() {
    $requiredFields = RequiredFields::create('Content', 'Image');
    return $requiredFields;
  }
  
  public function getCMSFields() {
    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          UploadField::create('Image', 'Bild')
	          ->setFolderName('sce')
	          ->setDisplayFolderName('sce'),
          HtmlEditorField::create('Content', 'Beschreibung')
	          ->setRows(20)
        )
      )
    );
    
    $this->extend('updateCMSFields', $fields);
    
    return $fields;
  }

	public function ProcessedImage() {
		$imgMode = self::config()->get('image_mode');
		$imgWidth = self::config()->get('image_width');
		$imgHeight = self::config()->get('image_height');

		return $this->Image()->$imgMode($imgWidth, $imgHeight);
	}
}