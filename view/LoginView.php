<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $model;
	private $session;

	public function __construct($m, $s) {
		$this->model = $m;
		$this->session = $s;
	}
	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = $this->checkInputData();
		
		$response = $this->generateLoginFormHTML($message);
		//$response .= $this->generateLogoutButtonHTML($message);
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		$currentUserName = "";
		if ($this->userWantsToLogIn() === true) {
			$currentUserName = $this->getRequestUserName();
			// echo $currentUserName;
		}

		return '
		<a href="?register">Register a new user</a>
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . (string)$currentUserName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	// private function getRequestUserName() {
	// 	//RETURN REQUEST VARIABLE: USERNAME
	// }

	public function getRequestUserName() {
		return $_POST[self::$name];
	}

	public function getRequestPassword() {
		return $_POST[self::$password];
	}

	public function userFilledInUsername() {
		if (isset($_POST[self::$name]) && !empty($_POST[self::$name])) {
			return true;
		}
		else {
			return false;
		}
	}

	public function userFilledInPassword() {
		if (isset($_POST[self::$password]) && !empty($_POST[self::$password])) {
			return true;
		}
		else {
			return false;
		}
	}

	public function userWantsToLogIn() {
		if (isset($_POST[self::$login])) {
			return true;
		}
		else {
			return false;
		}
	}

	public function getLoggedIn() {
		if (isset($_COOKIE["loggedIn"])) {
			return true;
		}

		
		return false;
	}
	
	private function checkInputData() {
		if (!$this->userFilledInPassword() && $this->userFilledInUsername() && $this->userWantsToLogIn()) {
			return 'Password is missing';
		}

		if (!$this->userFilledInUsername() && $this->userFilledInPassword() || !$this->userFilledInPassword() && $this->userWantsToLogIn()) {
			return 'Username is missing';
		}

		if ($this->userWantsToLogIn()) {
			if (!$this->model->usernameExists($this->getRequestUserName()) || !$this->model->checkUsernameAndPassword($this->getRequestUserName(), $this->getRequestPassword())) {
				return 'Wrong name or password';
			}
		}
			
		if ($this->userWantsToLogIn()) {
			if (!$this->session->isLoggedIn() && $this->model->usernameExists($this->getRequestUserName()) && $this->model->checkUsernameAndPassword($this->getRequestUserName(), $this->getRequestPassword())) {
				$this->session->setLoggedInSession(true);
				return 'Welcome';
			}
		}
		return '';
	}
}