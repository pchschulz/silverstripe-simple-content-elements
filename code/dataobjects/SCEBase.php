<?php
class SCEBase extends DataObject {

  private static $singular_name = 'Überschrift';
  private static $plural_name = 'Überschriften';

	private static $db = [
		'Title' => 'Varchar(255)',
		'ShowTitle' => 'Boolean',
		'SortOrder' => 'Int',
	];
	
	private static $has_one = [
	  'Page' => 'Page',
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
	  $can = Permission::check(['ADMIN', 'CMS_ACCESS']);

	  return $can;
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
					DropdownField::create('ShowTitle', 'Überschrift anzeigen', [1 => 'Ja', 0 => 'Nein'], 1)
				)
			)
		);

		if($this->ClassName == 'SCEBase') {
			$fields->removeByName('ShowTitle');
		}

	  $this->extend('updateCMSFields', $fields);

	  return $fields;
	}

	public function ClassNameForTemplate() {
		$class = $this->ClassName;
		$nice = strtolower(str_replace(['SCE', 'Element'], '', $class));
		return 'sce sce--' . $nice;
	}

	public function Layout() {
		return $this->renderWith($this->ClassName);
	}

	public function ProcessedImage() {
		if($this->hasMethod('Image')) {
			$imgMode = self::config()->get('image_mode');
			$imgWidth = self::config()->get('image_width');
			$imgHeight = self::config()->get('image_height');

			return $this->Image()->$imgMode($imgWidth, $imgHeight);
		}
	}
}