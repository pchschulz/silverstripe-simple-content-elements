<?php
class SCEBase extends DataObject {

  private static $singular_name = 'Überschrift';
  private static $plural_name = 'Überschriften';

	private static $db = [
		'Title' => 'Varchar(255)',
		'ShowTitle' => 'Boolean',
		'SortOrder' => 'Int',
		'SmallDistance' => 'Boolean',
	];
	
	private static $has_one = [
	  'Page' => 'Page',
		'AccordionItem' => 'SCEAccordion_Item',
	];

	private static $default_sort = 'SortOrder';
	
	private static $summary_fields = [
	  'Title' => 'Überschrift',
		'ShowTitle.Nice' => 'Titel anzeigen',
		'singular_name' => 'Typ',
	];

	public function onBeforeWrite() {
	  parent::onBeforeWrite();

		if($this->ClassName == 'SCEBase') {
			$this->ShowTitle = true;
		}
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

	public function getCMSValidator() {
	  $requiredFields = RequiredFields::create('Title');
	  return $requiredFields;
	}

	public function getCMSFields() {
		$fields = FieldList::create(
			TabSet::create('Root',
				Tab::create('Main', 'Hauptteil',
					TextField::create('Title', 'Überschrift'),
					DropdownField::create('ShowTitle', 'Überschrift anzeigen', [1 => 'Ja', 0 => 'Nein'], 0),
					DropdownField::create('SmallDistance', 'Kleiner Abstand', [1 => 'Ja', 0 => 'Nein'], 0)
						->setDescription('nur den halben Abstand zum oberen Element verwenden')
				)
			)
		);

		if($this->ClassName == 'SCEBase') {
			$fields->removeByName('ShowTitle');
		}

	  $this->extend('updateCMSFields', $fields);

	  return $fields;
	}

	public function ClassNameForTemplate($simple = false) {
		$class = $this->ClassName;
		$nice = strtolower(str_replace(['SCE', 'Element'], '', $class));

		if($simple) {
			return $nice;
		}
		
		return 'sce sce--' . $nice;
	}

	public function Layout() {
		return $this->renderWith($this->ClassName);
	}

	public function ProcessedImage() {
		if($this->hasMethod('Image')) {
			$imgMode = self::config()->get('image_mode');
			$imgWidth = self::config()->get('image_width');

			if($height = $this->ImageHeight) {
				$imgHeight = $height;
			} else {
				$imgHeight = self::config()->get('image_height');
			}

			return $this->Image()->$imgMode($imgWidth, $imgHeight);
		}
	}
}