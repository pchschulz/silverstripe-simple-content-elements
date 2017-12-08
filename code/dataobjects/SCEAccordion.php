<?php
class SCEAccordion extends SCEBase {

	private static $singular_name = 'Akkordeon';
	private static $plural_name = 'Akkordeons';

	private static $has_many = [
		'Items' => 'SCEAccordion_Item',
	];
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldsToTab('Root.Main', [
			GridField::create('Items', 'Elemente', $this->Items(), SCEGridConfig::create(30, 'SortOrder')),
		  LiteralField::create('SaveNotice', '<div class="message notice">Nach dem Speichern können Elemente hinzugefügt werden.</div>')
	  ]);

	  if(!$this->ID) {
		  $fields->removeByName('Items');
	  } else {
		  $fields->removeByName('SaveNotice');
	  }

		$this->extend('updateCMSFields', $fields);

		return $fields;
	}
}