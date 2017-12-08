<?php
class SCEExtension extends DataExtension {

	private static $has_many = [
		'SimpleContentElements' => 'SCEBase',
	];

	public function updateCMSFields(FieldList $fields) {
		$field = GridField::create('SimpleContentElements', 'Inhaltselemente', $this->owner->SimpleContentElements(), $fieldGC = SCEGridConfig::create(50, 'SortOrder'));
		$fieldGC->set(['multi']);

		if(Config::inst()->get($this->owner->ClassName, 'sce_remove_content_field') == true) {
			$fields->removeByName('Content');
		}

		if($fields->dataFieldByName('Content')) {
			$fields->insertAfter(Tab::create('SCE', 'Inhaltselemente'), 'Main');
			$fields->addFieldsToTab('Root.SCE', $field);
		} else if($fields->dataFieldByName('MenuTitle')) {
			$fields->insertAfter($field, 'MenuTitle');
		} else {
			$fields->addFieldToTab('Root.Main', $field);
		}
	}
}