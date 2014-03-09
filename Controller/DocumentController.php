<?php
class DocumentController extends AppController {
	var $name = "Document";

	public function add() {
		$document_id = $this->params['named']['id'];
	}

	public function edit() {
		$document_id = $this->params['named']['id'];
	}

	public function delete() {
		$document_id = $this->params['named']['id'];
	}
}
?>