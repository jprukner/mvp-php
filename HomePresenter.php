<?
class HomePresenter extends PrivatePresenter {
	public function render(){
		View::display($this->page, [
			'title'=>'verz nice',
			'welcome' => 'welcome dear friend'
		]);
	}
	public function OnLogin(){
		echo "shit";
	}
}