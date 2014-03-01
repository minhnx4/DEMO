<?php 
class Lesson extends AppModel {
	public $belongsTo="Lecturer";
	public $hasAndBelongsToMany = "Tag";
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'summary' => array(
            'lenght' => array(
                'rule'    => array('maxLength', '2000'),
                'message' => 'Maximum 2000 characters long'
            ),
                        
        )
    );


}