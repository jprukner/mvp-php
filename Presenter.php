<?
// A base presenter.
abstract class Presenter {
	// $page stores presenter's name.
	// It is used to identify a view in Presenter's childs.
	protected $page;
	protected $data; // user's input data
	protected $model; // the data source

	public function __construct(string $page, array $data) {
		if(!$this->isPossibleToAccess()){
			// TODO REDIRECT TO ACCESS DENIED PAGE.
			return;
		}
		$this->page = $page;
		$this->data = $data;
		$Model = $page.'Model';
		if(file_exists($Model.'.php')){ // Model is optional.
			$this->model = new $Model();
		}
		if(isset($data['action']) && $data['action'] != ''){
			$method = 'On'.ucfirst($data['action']);
			if(method_exists($this, $method)){
				$this->$method();
				return;
			}
		}
		$this->render();
	}
	// render is a default handler for the request. 
	abstract protected function render();
	// isPossibleToAccess defines rules for user accessing presenter and it's actions.
	abstract protected function isPossibleToAccess(): bool;
}
