<?php 
class Tag extends AppModel {
	public $hasAndBelongsToMany  = "Lesson";
}