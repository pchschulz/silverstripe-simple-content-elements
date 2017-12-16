<?php
class SCEDescribedImages_Image extends DataObject {

  private static $singular_name = 'Bild';
  private static $plural_name = 'Bilder';

  private static $db = [
  	'Content' => 'HTMLText',
	  'SortOrder' => 'Int',
	  'ImagePosition' => 'Varchar(10)',
	  'Link' => 'NamedLinkField',
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

	public function canCreate($member = null) {
		return Controller::curr()->currentPage()->canCreate($member);
	}

	public function canView($member = null) {
		return Controller::curr()->currentPage()->canView($member);
	}

	public function canEdit($member = null) {
		return Controller::curr()->currentPage()->canEdit($member);
	}

	public function canDelete($member = null) {
		return Controller::curr()->currentPage()->canDelete($member);
	}
  
  public function getCMSFields() {
    $fields = FieldList::create(
      TabSet::create('Root',
        Tab::create('Main', 'Hauptteil',
          UploadField::create('Image', 'Bild')
	          ->setFolderName('images')
	          ->setDisplayFolderName('images'),
	        DropdownField::create('ImagePosition', 'Position des Bildes', [
		        'top' => 'Oben',
		        'bottom' => 'Unten',
	        ]),
	        NamedLinkFormField::create('Link', 'Link'),
          HtmlEditorField::create('Content', 'Beschreibung')
	          ->setRows(20)
        )
      )
    );
    
    $this->extend('updateCMSFields', $fields);
    
    return $fields;
  }

	public function ProcessedImage() {
		$element = $this->Element();

		$imgMode = self::config()->get('image_mode');

		if($element->ImagesPerRow == 2) {
			$imgWidth = self::config()->get('two')['image_width'];
			$imgHeight = self::config()->get('two')['image_height'];

		} else if($element->ImagesPerRow == 3) {
			$imgWidth = self::config()->get('three')['image_width'];
			$imgHeight = self::config()->get('three')['image_height'];
		}

		if($height = $element->ImageHeight) {
			$imgHeight = $height;
		}

		return $this->Image()->$imgMode($imgWidth, $imgHeight);
	}
}