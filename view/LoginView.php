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
	private $loggedInFistTime = false;

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

		if ($this->session->isLoggedIn()) {
			$response = $this->generateLogoutButtonHTML($message);
		}
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

	public function getRequestUserName() {
		return $_POST[self::$name];
	}

	public function getRequestPassword() {
		return $_POST[self::$password];
	}

	public function getKeepLoggedIn() {
		if (isset($_POST[self::$keep])) {
			return true;
		}
		return false;
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

	public function userPressedLogout() {
		if (isset($_POST[self::$logout])) {
			return true;
		}
		else {
			return false;
		}
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

		if ($this->userWantsToLogIn() && $this->getKeepLoggedIn()) {
			$this->session->setKeepLoggedIn();
		}
		
			
		if ($this->userWantsToLogIn()) {
			if ($this->loggedInFistTime === true && $this->model->usernameExists($this->getRequestUserName()) && $this->model->checkUsernameAndPassword($this->getRequestUserName(), $this->getRequestPassword())) {
				$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
				if ($pageWasRefreshed && $this->session->isLoggedIn()) {
					return '';
				}
				return 'Welcome';
			}
		}

		if ($this->userPressedLogout()) {
			return 'Bye bye!';
		}

		if ($this->session->isLoggedIn() && $this->userPressedLogout()) {
			$this->changeLoggedInFirstTime(false);
		}

		// $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
		// var_dump($pageWasRefreshed);
		return '';
	}


	public function changeLoggedInFirstTime($state) {
		$this->loggedInFistTime = $state;
	}
}