<?
class LoginModel extends Model {
	public function getUserByEmail(string $email){
		$user = $this->selectFrom("user", "user_id, name, password")
					 ->where("email = ?")
					 ->execute([$email], False);
		return $user;
	}
}