<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class News {

	private $id;
	private $date;
	private $title;
	private $teaser;
	private $text;
	private $tags;
	

	public function __construct() {

		// Берем последний id из базы и делаем инкремент
		$lastId = DB::table('news')->select('id')->orderBy('id', 'desc')->first()->id;
		$this->id = $lastId + 1;

		// Ставим текущую дату
		$this->date = date('Y.m.d H:i:s');

	}

	// добавление новость в базу
	public function add() {

		DB::table('news')->insert([
			'id' => $this->getId(),
			'date' => $this->getDate(),
			'title' => $this->getTitle(),
			'teaser' => $this->getTeaser(),
			'text' => $this->getText(),
			'tags' => $this->getTags()
		]);
	}

	// удаление новости по id
	public function delete($id) {
		DB::table('news')->where('id', $id)->delete();
	}

	public function find($column, $value) {			
		$findedNews = DB::table('news')->where($column, $value)->first();
		return $findedNews;
	}

	// получаем список всех новостей
	public function getAll() {
		$news = DB::table('news')->select('*')->get()->all();
		return $news;
	}


	// Геттеры
	public function getId () {
		return $this->id;
	}
	public function getDate () {
		return $this->date;
	}
	public function getTitle () {
		return $this->title;
	}
	public function getTeaser () {
		return $this->teaser;
	}
	public function getText () {
		return $this->text;
	}
	public function getTags () {
		return $this->tags;
	}
	

	// Сеттеры
	public function setTitle ($value) {
		$this->title = $value;		
	}
	public function setTeaser ($value) {
		$this->teaser = $value;
	}
	public function setText ($value) {
		$this->text = $value;
	}
	public function setTags ($value) {
		$this->tags = $value;
	}	

}