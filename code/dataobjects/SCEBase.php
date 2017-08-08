<?php
class SCEBase extends DataObject {

  private static $singular_name = 'Inhaltselement';
  private static $plural_name = 'Inhaltselemente';

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
	  'Title' => 'Titel',
		'ShowTitle.Nice' => 'Titel anzeigen',
	];

	public function getCMSValidator() {
	  $requiredFields = RequiredFields::create('Title');
	  return $requiredFields;
	}

	public function getCMSFields() {
		$fields = FieldList::create(
			TabSet::create('Root',
				Tab::create('Main', 'Hauptteil',
					FieldGroup::create(
						TextField::create('Title', 'Überschrift'),
						DropdownField::create('ShowTitle', 'Überschrift anzeigen', [1 => 'Ja', 0 => 'Nein'], 1)
					)->setTitle('Überschrift')
				)
			)
		);

	  $this->extend('updateCMSFields', $fields);

	  return $fields;
	}

	public function ClassNameForTemplate() {
		$class = $this->ClassName;
		$nice = str_replace(['SCE', 'Element'], '', $class);
		return 'sce sce--' . $nice;
	}

	public function Layout() {
		return $this->renderWith($this->ClassName);
	}
}