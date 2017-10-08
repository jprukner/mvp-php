<?
class HomePresenter extends Presenter {
	public function __construct(string $page){
		parent::__construct($page);
		View::display($page, [
			'title'=>'verz nice',
			'welcome' => 'welcome dear friend'
		]);
	}
}