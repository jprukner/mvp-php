<?
// A base presenter.
abstract class Presenter {
	// $page stores presenter's name.
	// It is used to identify a view in the Presenter's childs.
	protected $page;
	protected $model; // the data source
	public function __construct(string $page) {
		$this->page = $page;
		$Model = $page.'Model';
		if(file_exists($Model)){ // A model class is optional.
			$this->model = new $Model();
		}
	}
}