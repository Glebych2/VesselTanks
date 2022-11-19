<?php

	class Helper {
	
		public function generateToken($size = 32) {

			$symbols = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'a', 'b', 'c', 'd', 'e'];
			$symbols_length = count($symbols);
			$token = '';
			for ($i = 0; $i < $size; $i++) {
				$token .= $symbols[rand(0, $symbols_length - 1)];
			}
			return $token;
		}
		
		
	
	}




?>