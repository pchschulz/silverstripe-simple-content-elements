<?php
class SCEExtension extends DataExtension {

	private static $has_many = [
		'ContentElements' => 'SCEElement',
	];

	public function updateCMSFields(FieldList $fields) {
		$field = GridField::create('ContentElements', 'Inhaltselemente', $this->owner->ContentElements(), $fieldGC = SCEGridConfig::create(30, 'SortOrder'));
		$fieldGC->set(['multi']);

		if($fields->dataFieldByName('Content')) {
			$fields->insertBefore($field, 'Content');
		} else if($fields->dataFieldByName('Metadata')) {
			$fields->insertBefore($field, 'Metadata');
		} else {
			$fields->push($field);
		}

		if(self::config()->get('remove_content_field') == true) {
		  $fields->removeByName('Content');
	  }
	}
}