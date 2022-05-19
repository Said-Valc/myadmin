<?php

class MainController extends Controller {
	
	
	
	
	public function actionIndex(){
		$this->title = "title";
		$this->meta_desc = "meta_desc";
		$this->meta_key = "meta_key";
		$this->render('');
	}
	
	public function actionLessons(){
		$data = LessonsDB::getLessons($this->request->lang);
		$hour = LessonsDB::getHoursInLessonsAndLessonsses();
		if($this->request->addIdea) LessonsDB::insertLesson();
		$module = new Lessons();
		$module->data = $data;
		$module->hour = $hour;
		$this->render($module);
	}
	
	
	public function actionLessonses(){
		$lessonses = LessonsesDB::getLessonsesOnID($this->request->lessons_id);
		$module = new Lessonses();
		$module->data = $lessonses;
		$lesobj = new LessonsesDB();
		if($this->request->redactLessonses) $lesobj->updateData($this->request);
		$this->render($module);
	}
	
	public function actionUrokPodrobnee(){
		$up = new urokPodrobneeDB();
		$data = $up->getAllOnID($this->request->id);
		if(!$data) exit('Ошибка из-за отстутсвия урока');
		$module = new JSUrokPodrobnee();
		$module->data = $data;
		$this->render($module);
	}
	
	public function actionNotes(){
		$notes = new NotesDB();
		$module = new Notes();
		$this->render($module);
	}
	
	public function actionDnevnik(){
		print 'w';
	}
	
	public function actionBook(){
		$book = new BookDB();
		if(isset($_POST['clickBook'])){
			$book->insertBook($_POST);
		}
		$module = new book();
		$this->render($module);
	}
	
	public function actionMybooks(){
		
		$pages = new PagesDB();
		$book = new BookDB();
		$mybooks = new MyBooks();
		$mybooks->books = $book->getAllBook();
		$mybooks->pages = $pages->getAllPages();
		if(isset($_GET['view']) and $_GET['view'] == 'edit'){
			$module = new Pages();
			$module->data = $pages->getPageOnID($_GET['id']);
			if(isset($_POST['click'])){
				$pages->updatePage($_POST, $_GET['id']);
				header('Location: '. $_SERVER['REQUEST_URI']);
			}
			$this->render($module);
		}elseif(isset($_GET['view']) and $_GET['view'] == 'typography'){
			$module = new Typography();
			$module->data = $pages->getPageOnID($_GET['id']);
			$this->render($module);
		}else{
			$this->render($mybooks);
		}
	}
	
	public function actionPages(){
		$pages = new PagesDB();
		$book = new BookDB();
		$pages->insertPage($_POST);
		$module = new Pages();
		$module->data = $book->getAllBook();
		$this->render($module);
	}
	
	public function actionIdea(){
		$data = IdeaDB::getIdea();
		if($this->request->redact) $data = IdeaDB::redactIdea($this->request);
		if($this->request->redactSuccess)  IdeaDB::redactSuccess($this->request);
		if($this->request->deleteIdea)  IdeaDB::deleteIdea($this->request);
		if($this->request->addIdea) ideaDB::addIdea($this->request);
		$module = new Idea();
		$module->data = $data;
		$this->render($module);
	}
	
	public function actionWorkout(){
		$wor = new WorkoutDB();
		$worresult = new WorkoutresultDB();
		$worresult->updateTable($wor->getAllOnID());
		$dataWR = $worresult->getTable();
		$data = $wor->getAllOnID();
		if($this->request->addWorkout) $wor->addWorkout($_POST);
		$module = new Workout();
		$module->data = $data;
		$module->dataWR = $dataWR;
		$this->render($module);
	}
	
	
	
	
}

?>