<?
abstract class PrivatePresenter extends Presenter {
	// PrivatePresenter's function isPossibleToAccess permits
	// the access only when user is logged in.
	protected function isPossibleToAccess(): bool {
		return isset($_SESSION['id']) && $_SESSION['id'] != 0; 
	}
}