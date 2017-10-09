<?
abstract class PublicOnlyPresenter extends Presenter {
	// PublicOnlyPresenter's function isPossibleToAccess permits
	// the access only when user is NOT logged in. 
	protected function isPossibleToAccess(): bool {
		return !isset($_SESSION['id']); 
	}
}