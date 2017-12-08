<?php
class SCEControllerExtension extends DataExtension {

	public function onAfterInit() {
		Requirements::javascript('simple-content-elements/js/sce.js');
	}
}