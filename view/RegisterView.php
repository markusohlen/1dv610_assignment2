<?php

class RegisterView {
    private static $userName = "RegisterView::UserName";
    private static $registerViewMessage = "RegisterView::Message";
    private static $password = "RegisterView::Password";
    private static $passwordRepeat = "RegisterView::PasswordRepeat";
	

	/**
	 * Create HTTP response
	 *
	 * Should be called after a Register attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
        $message = '';
		
		$response = $this->generateRegisterFormHTML($message);
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
	private function generateRegisterFormHTML($message) {
		return '
        <a href="?">Back to Login</a><div class="container" >
          
                <h2>Register new user</h2>
                <form action="?register" method="post" enctype="multipart/form-data">
                    <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                        <p id="' . self::$registerViewMessage . '"></p>
                        <label for="' . self::$userName . '" >Username :</label>
                        <input type="text" size="20" name="' . self::$userName . '" id="' . self::$userName . '" value="" />
                        <br/>
                        <label for="' . self::$password . '" >Password  :</label>
                        <input type="password" size="20" name="' . self::$password . '" id="' . self::$password . '" value="" />
                        <br/>
                        <label for="' . self::$passwordRepeat . '" >Repeat password  :</label>
                        <input type="password" size="20" name="' . self::$passwordRepeat . '" id="' . self::$passwordRepeat . '" value="" />
                        <br/>
                        <input id="submit" type="submit" name="DoRegistration"  value="Register" />
                        <br/>
                    </fieldset>
                </form>
		';
	}
	
	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	// private function getRequestUserName() {
	// 	return $_POST[self::$userName];
    // }
    public function getRequestUserName() {
		return $_POST[self::$userName];
    }
    
    public function getRequestPassword() {
        return $_POST[self::$password];
    }

    public function getRequestPasswordRepeat() {
        return $_POST[self::$passwordRepeat];
	}
	
	public function personRegistered() {
		if (isset($_POST[self::$userName]) && isset($_POST[self::$password]) && isset($_POST[self::$passwordRepeat])) {
			return true;
		} else {
			return false;
		}
		
	}
	
}

