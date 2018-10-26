<?php
class SCEAccordion_Item extends DataObject {

	private static $singular_name = 'Akkordeon Element';
	private static $plural_name = 'Akkordeon Elemente';

	private static $db = [
	  'Title' => 'Varchar(255)',
	  'Content' => 'HTMLText',
		'SortOrder' => 'Int',
	];

	private static $default_sort = 'SortOrder';

	private static $has_one = [
	  'Accordion' => 'SCEAccordion',
	];
	
	public function getCMSValidator() {
	  $requiredFields = RequiredFields::create('Title');
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
	        TextField::create('Title', 'Titel'),
	        HtmlEditorField::create('Content', 'Inhalt')
	      )
	    )
	  );
	  
	  $this->extend('updateCMSFields', $fields);
	  
	  return $fields;
	}
}