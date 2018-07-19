<?php

class Snap {

	/**
	 * randomly generated 10 char long string
	 * @var string $randomString
	 */
	private $randomString;

	/**
	 * @var
	 */
	private $randomInt;

	/**
	 * constructor for this random string & int
	 *
	 * @param string $newRandomString
	 * @param int $newRandomInt
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(string $newRandomString, int $newRandomInt) {
		try {
			$this->setRandomString($newRandomString);
			$this->setRandomInt($newRandomInt);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


//			//determine what exception type was thrown
//		} catch(\InvalidArgumentException) {
//		} catch(\RangeException) {
//		} catch(\TypeError) {
//		} catch(\Exception) {
//		}


		/**
		 * @param $length
		 * @return string
		 */
		public
		function genRandomString($length) {
			$result = "";
			$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_?!-9";
			$charArray = str_split($chars);
			for($i = 0; $i < $length; $i++) {
				$randItem = array_rand($charArray);
				$result .= "" . $charArray[$randItem];
			}
			return $result;
		}


		/**
		 * @param $length
		 * @return int|string
		 */
		public
		function genRandomNumber($length) {
			for($randomNumber = mt_rand(1, 9), $i = 1; $i < $length; $i++) {
				$randomNumber .= mt_rand(0, 9);
			}
			return $randomNumber;
		}

		/**
		 * accessor method for randomString
		 *
		 * @return string value of 10 char in length
		 **/
		public
		function getRandomString(): string {
			return $this->randomString;
		}

		/**
		 * mutator method for random string
		 *
		 * @param string $newRandomString new value of string
		 * @throws \InvalidArgumentException if $newRandomString is not a valid string or insecure
		 * @throws \RangeException if $newRandomString is > 10 characters
		 * @throws \TypeError if $newRandomString is not a string
		 * @return string
		 **/
		public
		function setRandomString(string $newRandomString): string {
			// verify the random string is secure
			$newRandomString = $this->genRandomString(10);
			$newRandomString = trim($newRandomString);
			$newRandomString = filter_var($newRandomString, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newRandomString) === true) {
				throw(new \InvalidArgumentException("random string is empty or insecure"));
			}
			// verify the random string will fit in the database
			if(strlen($newRandomString) > 10) {
				throw(new \RangeException("random string is too large"));
			}
			// store the random string
			$this->randomString = $newRandomString;
		}


		/**
		 * @return int
		 */
		public
		function getRandomInt(): int {
			return $this->randomInt;
		}

		/**
		 * mutator method for random string
		 *
		 * @param int $newRandomInt new value of int
		 * @throws \InvalidArgumentException if $newRandomInt is not a valid int or insecure
		 * @throws \RangeException if $newRandomInt is > 10 numbers
		 * @throws \TypeError if $newRandomInt is not an int
		 * @return int
		 **/
		public
		function setRandomInt(int $newRandomInt): int {
			// verify the random number is secure
			$newRandomInt = $this->genRandomNumber(10);
			$newRandomInt = trim($newRandomInt);
			$newRandomInt = filter_var($newRandomInt, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newRandomInt) === true) {
				throw(new \InvalidArgumentException("random number is empty or insecure"));
			}
			// verify the random number will fit in the database
			if(strlen($newRandomInt) > 10) {
				throw(new \RangeException("random number is too large"));
			}
			// store the random number
			$this->randomInt = $newRandomInt;
		}

	}
