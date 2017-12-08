<?php
class SCEAccordion_Item extends DataObject {

	private static $singular_name = 'Akkordeon Element';
	private static $plural_name = 'Akkordeon Elemente';

	private static $db = [
	  'Title' => 'Varchar(255)',
	  'Content' => 'HTMLText',
		'SortOrder' => 'Int',
	];

	private static $has_one = [
	  'Accordion' => 'SCEAccordion',
	];
	
	public function getCMSValidator() {
	  $requiredFields = RequiredFields::create('Title');
	  return $requiredFields;
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