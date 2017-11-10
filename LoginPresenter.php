<?
class LoginPresenter extends PublicOnlyPresenter {
	public function render(){
		View::display($this->page, []);
	}
	// OnLogin sets user's data into the session variable if an authentication is successful.
	public function OnLogin(){
		$email    = $this->data['email'];
		$password = $this->data['password'];
		if($email == "" || $password == ""){
			return;
		}
		$user = $this->model->getUserByEmail($email);
		// var_dump($user);
		if(!$user) {
			// no such user
			return;
		}
		if(!password_verify($password, $user['password'])){
			// password does not match hash
			return;
		}	
		//  todo    CREATE A PAGE WHERE ALL USERS CAN VIEW STUFFS, USE JOIN, MAYBE ARTICLES.
		//      CREATE A PAGE WHERE ONLY AUTHENTICATED USERS CAN EDIT ARTICLES.
		$_SESSION['id']   = $user['user_id'];
		$_SESSION['name'] = $user['name'];
		// etc.
	}
}