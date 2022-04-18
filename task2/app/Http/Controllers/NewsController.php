<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    // выводим список всех новостей
    public function index () {    	
    	$news = new News;
    	return view('index', ['news' => $news->getAll()]);
    }

    // форма добавления новости
    public function createForm() {    	
    	return view('create');
    }

    // добавление новости
    public function createAction(Request $request) {      	

    	$news = new News;    

    	$news->setTitle($request->get('title'));
    	$news->setTeaser($request->get('teaser'));
    	$news->setText($request->get('text'));
    	$news->setTags($request->get('tags'));

    	$news->add();

    	return redirect('/');
    }
 
    // удаление новости
    public function delete($id) { 

    	$news = new News;
    	$news->delete($id);
    	return redirect('/');    	
    }

    // поиск новости по id
    public function findById($id) {

    	$news = new News;
    	$findedNews = $news->find('id', $id);

    	// рендерим новость
    	return view('show', ['news' => $findedNews]);

    }

    // поиск новости по заголовку
    public function findByQuery($query) {

    	$news = new News;
    	$findedNews = $news->find('title', $query);

    	// рендерим новость
    	return view('show', ['news' => $findedNews]);

    }
}

