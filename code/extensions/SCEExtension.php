<?php
class SCEExtension extends DataExtension {

	private static $has_many = [
		'SimpleContentElements' => 'SCEBase',
	];

	public function updateCMSFields(FieldList $fields) {
		$field = GridField::create('SimpleContentElements', 'Inhaltselemente', $this->owner->SimpleContentElements(), $fieldGC = SCEGridConfig::create(30, 'SortOrder'));
		$fieldGC->set(['multi']);

		if($fields->dataFieldByName('Content')) {
			$fields->insertBefore($field, 'Content');
		} else if($fields->dataFieldByName('MenuTitle')) {
			$fields->insertAfter($field, 'MenuTitle');
		} else {
			$fields->addFieldToTab('Root.Main', $field);
		}

		if(Config::inst()->get(__CLASS__, 'remove_content_field') == true) {
		  $fields->removeByName('Content');
	  }
	}
}