<?
abstract class PublicPresenter extends Presenter {
	// PublicPresenter's funciton isPossibleToAccess permits access always. 
	protected function isPossibleToAccess(): bool {
		return True;
	}
}