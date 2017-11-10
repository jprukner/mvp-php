<?
class HomePresenter extends PublicPresenter {
	public function render(){
		View::display($this->page, [
			'title'=>'verz nice',
			'welcome' => 'welcome dear friend'
		]);
	}
}