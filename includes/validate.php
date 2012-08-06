<?php
	/**
	* Validates a text
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	int $minChars minimum length
	* @param	int $maxChars maximum length
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	bool $onlyText if set to TRUE numbers are not allowed
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateText($field, $value, $minChars, $maxChars, $required, $unique, $onlyText, $defaultValue, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && ($value == "" || $value == $defaultValue)) {
			$errors[$field] = 'empty';
		} else {
			if (strlen($value) < $minChars) {
				$errors[$field] = 'min_length';	
			} else if (strlen($value) > $maxChars) {
				$errors[$field] = 'max_length';
			} else {
				if ($onlyText && preg_match('/\d/', $value) != FALSE) {
					$errors[$field] = 'only-text';
				} else if ($unique) {
			
					$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
					$row = new_fetch($result);
					$total = $row['total'];
					
					if ($total > 0) {
						$errors[$field] = 'unique';	
					}
				}
			}
		}
	}
	
	/**
	* Validates a number
	*
	* @param	string $field a name to identify the number
	* @param	mixed $value the number to be validated
	* @param	int $min minimum
	* @param	int $max maximum
	* @param	bool $required if set to TRUE the number can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateNumber($field, $value, $min, $max, $required, $unique, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';
		} else {
			if ($value < $min) {
				$errors[$field] = 'min';	
			} else if ($value > $max) {
				$errors[$field] = 'max';
			} else {
				if (ctype_digit($value) == FALSE) {
					$errors[$field] = 'format';
				} else if ($unique) {
			
					$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
					$row = new_fetch($result);
					$total = $row['total'];
					
					if ($total > 0) {
						$errors[$field] = 'unique';	
					}
				}
			}
		}
	}
	
	/**
	* Validates a text as CPF (Cadastro de Pessoas Físicas)
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $forbidden_values an array of CPFs that can't be used
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateCPF($field, $value, $required, $unique, $table, $column, $default_value, $forbidden_values, &$errors) {
		
		$value = trim(str_replace("/", "", str_replace("-", "", str_replace(".", "", $value)))); 
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';	
		} else {
			
			$error = FALSE;

			if (empty($value) || strlen($value) != 11) 
				$error = TRUE;
			else {
				
				$fake = FALSE;
				
				for($i = 0; $i <= 9; $i++) {
            		$dummy = str_pad("", 11, $i);
            		if($value === $dummy) {
						$fake = TRUE;
					}
        		}
				
				if ($fake == TRUE) {
					$error = TRUE;
				} else {
					$dv = 0;
					
					$sub_value = substr($value, 0, 9);
					for($i =0; $i < 9; $i++) {
						$dv += ($sub_value[$i] * (10 - $i));
					}
					if ($dv == 0) {
						echo 1;
						$error = TRUE;
					}
						
					$dv = 11 - ($dv % 11); 
					if ($dv > 9) $dv = 0;
					if ($value[9] != $dv) { 
						echo 2;
						$error = TRUE;
					}
	
					$dv *= 2;
					for($i = 0; $i < 9; $i++) {
						$dv += ($sub_value[$i] * (11 - $i));
					}
					$dv = 11 - ($dv % 11); 
					if($dv > 9) $dv = 0;
					if($value[10] != $dv) {
						echo 3;
						$error = TRUE;
					}
				}
			} 
			
			if ( ( $required || (!$required && $value != $default_value) ) && $error) {
				$errors[$field] = 'format';
			} else if (is_array($forbidden_values) && in_array($value, $forbidden_values)) {
				$errors[$field] = 'forbidden_value';								
			} else if ($unique) {
				
				$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
				$row = new_fetch($result);
				$total = $row['total'];
				
				if ($total > 0) {
					$errors[$field] = 'unique';	
				}
			}
		}
	}
	
	/**
	* Validates a text as CNH (Carteira Nacional de Habilitação) 
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateCNH($field, $value, $required, $unique, $table, $column, &$errors) {
		
		$value = sprintf('%011s', preg_replace('{\D}', '', trim($value)));
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';	
		} else {
	
			$error = FALSE;
	
			// Validate length and invalid numbers
			if ((strlen($value) != 11) || (intval($value) == 0)) {
				$error = TRUE;
			}
	
			// Validate check digits using a modulus 11 algorithm
			for ($c = $s1 = $s2 = 0, $p = 9; $c < 9; $c++, $p--) {
				$s1 += intval($value[$c]) * $p;
				$s2 += intval($value[$c]) * (10 - $p);
			}
	
			if ($value[9] != (($dv1 = $s1 % 11) > 9) ? 0 : $dv1) {
				$error = TRUE;
			}
	
			if ($value[10] != (((($dv2 = ($s2 % 11) - (($dv1 > 9) ? 2 : 0)) < 0) ? $dv2 + 11 : $dv2) > 9) ? 0 : $dv2) {
				$error = TRUE;
			}
			
			if ($error) {
				$errors[$field] = 'format';
			} else if ($unique) {
				
				$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
				$row = new_fetch($result);
				$total = $row['total'];
				
				if ($total > 0) {
					$errors[$field] = 'unique';	
				}
			}
		}
	}
	
	/**
	* Validates a text as RG (Registro Geral) 
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateRG($field, $value, $required, $unique, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';	
		} else {
			if (FALSE) {
				$errors[$field] = 'format';
			} else if ($unique) {
				
				$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
				$row = new_fetch($result);
				$total = $row['total'];
				
				if ($total > 0) {
					$errors[$field] = 'unique';	
				}
			}
		}
	}
	
	/**
	* Validates a text as an e-mail
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	int $minChars minimum length
	* @param	int $maxChars maximum length
	* @param	bool $strict if set to TRUE the email must be RFC 822 compliant
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateEmail($field, $value, $minChars, $maxChars, $strict, $required, $unique, $table, $column, &$errors, $Id = -1) {
		
		$value = trim($value);
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';	
		} else {
			if (strlen($value) < $minChars) {
				$errors[$field] = 'min_length';	
			} else if (strlen($value) > $maxChars) {
				$errors[$field] = 'max_length';	
			} else {
				if ($strict === TRUE) {
				
					$qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
					$dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
					$atom  = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
					$pair  = '\\x5c[\\x00-\\x7f]';
		
					$domain_literal = "\\x5b($dtext|$pair)*\\x5d";
					$quoted_string  = "\\x22($qtext|$pair)*\\x22";
					$sub_domain     = "($atom|$domain_literal)";
					$word           = "($atom|$quoted_string)";
					$domain         = "$sub_domain(\\x2e$sub_domain)*";
					$local_part     = "$word(\\x2e$word)*";
		
					$expression     = "/^$local_part\\x40$domain$/D";
				} else {
					$expression = '/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD';
				}
			
				if (!(bool) preg_match($expression, $value)) {
					$errors[$field] = 'format';	
				} else if ($unique) {
					
					if ($Id == -1) {
						$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
					} else {
						$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "' AND Id !=" . mysql_real_escape_string($Id));
					}
					$row = new_fetch($result);
					$total = $row['total'];
					
					if ($total > 0) {
						$errors[$field] = 'unique';	
					}
				}
			}
		}
	}
	
	/**
	* Validates a text in the 'YYYY-MM-DD' format as a date
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $older if set to TRUE the date must older than $older_than in years
	* @param	int $older_than when $older is TRUE the date must be older in years than this value
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateDate($field, $value, $required, $older, $older_than, $unique, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && ($value == "" || is_null($value))) {
			$errors[$field] = 'empty';	
		} else {
			list($year, $month, $day) = explode("-", $value);
	
			if (!checkdate($month, $day, $year)) {
				$errors[$field] = "format";
			} else if ($older) {
				
				$year_diff  = date("Y") - $year;
				$month_diff = date("m") - $month;
				$day_diff   = date("d") - $day;
				if ($day_diff < 0 || $month_diff < 0)
					$year_diff--;
			
				if ($year_diff < $older_than) {
					$errors[$field] = 'older';
				}				
			
			} else if ($unique) {
				
				$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
				$row = new_fetch($result);
				$total = $row['total'];
				
				if ($total > 0) {
					$errors[$field] = 'unique';	
				}
			}
		}
	}

	/**
	* Validates a select field
	*
	* @param	string $field a name to identify the select
	* @param	mixed $value the text to be validated
	* @param	int $noValue this value is used to determine if the user selected something or not
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateSelect($field, $value, $noValue, $required, $unique, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && ($value == "" || $value == $noValue)) {
			$errors[$field] = 'empty';
		} else {
			if ($unique) {
				
				$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
				$row = new_fetch($result);
				$total = $row['total'];
				
				if ($total > 0) {
					$errors[$field] = 'unique';	
				}
			}
		}
	}
	
	/**
	* Validates a checkbox field
	*
	* @param	string $field a name to identify the checkbox (or group of checkboxes)
	* @param	array $value an array of values from a group of checkbox (even if it's one checkbox)
	* @param	int $minCheckbox the mininum number of checkbox from this group that must be checked
	* @param	bool $required if set to TRUE the checkbox can't be empty
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateCheckbox($field, array $value, $minCheckbox, $required, &$errors) {
		
		if ($required && empty($value)) {
			$errors[$field] = 'empty';
		} else {
			if (count($value) < $minCheckbox) {
				$errors[$field] = 'min_checkbox';	
			}
		}
	}
	
	/**
	* Validates a text as link (valid URL) - Based on http://www.apps.ietf.org/rfc/rfc1738.html#sec-5
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	int $minChars minimum length
	* @param	int $maxChars maximum length
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	bool $unique if set to TRUE the functions checks if the $value is already used in $column of the $table
	* @param	string $table when $unique is TRUE this must be the name of the table where the 'unique' validation is made
	* @param	string $column when $unique is TRUE this must be the name of the $column of the $table where the 'unique' validation is made
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateLink($field, $value, $minChars, $maxChars, $required, $unique, $table, $column, &$errors) {
		
		$value = trim($value);
		
		if ($required && $value == "") {
			$errors[$field] = 'empty';	
		} else {
			if (strlen($value) < $minChars) {
				$errors[$field] = 'min_length';	
			} else if (strlen($value) > $maxChars) {
				$errors[$field] = 'max_length';	
			} else {
				
				$error = FALSE;
				
				// Based on http://www.apps.ietf.org/rfc/rfc1738.html#sec-5
				if ( ! preg_match(
					'~^
		
					# scheme
					[-a-z0-9+.]++://
		
					# username:password (optional)
					(?:
							[-a-z0-9$_.+!*\'(),;?&=%]++   # username
						(?::[-a-z0-9$_.+!*\'(),;?&=%]++)? # password (optional)
						@
					)?
		
					(?:
						# ip address
						\d{1,3}+(?:\.\d{1,3}+){3}+
		
						| # or
		
						# hostname (captured)
						(
								 (?!-)[-a-z0-9]{1,63}+(?<!-)
							(?:\.(?!-)[-a-z0-9]{1,63}+(?<!-)){0,126}+
						)
					)
		
					# port (optional)
					(?::\d{1,5}+)?
		
					# path (optional)
					(?:/.*)?
		
					$~iDx', $value, $matches)) {
					$error = TRUE;
				} else {
		
					// We matched an IP address
					if ( ! isset($matches[1])) {
						$error = FALSE;
					} else {
						// Check maximum length of the whole hostname
						// http://en.wikipedia.org/wiki/Domain_name#cite_note-0
						if (strlen($matches[1]) > 253) {
							$error = TRUE;
						} else {
							// An extra check for the top level domain
							// It must start with a letter
							$tld = ltrim(substr($matches[1], (int) strrpos($matches[1], '.')), '.');
							$error = !ctype_alpha($tld[0]);
						}	
					}
				}				
			
				if ($value != "" && $error) {
					$errors[$field] = 'format';	
				} else if ($unique) {
					
					$result = new_query("SELECT COUNT(*) AS total FROM $table WHERE $column = '" . mysql_real_escape_string($value) . "'");
					$row = new_fetch($result);
					$total = $row['total'];
					
					if ($total > 0) {
						$errors[$field] = 'unique';	
					}
				}
			}
		}
	}

	/**
	* Validates an uploaded file
	*
	* @param	string $field a name to identify the text
	* @param	mixed $value the text to be validated
	* @param	array $types an array of allowed file extensions
	* @param	string $maxSize maximum size of the file. For example: '1M'
	* @param	bool $required if set to TRUE the text can't be empty
	* @param	array $errors an array where the errors are collected. $field is used as key, and the type of error as value
	*/
	function validateFile($field, $value, array $types, $maxSize, $required, &$errors) {
		
		if ($required && (!Kohana_Upload::not_empty($value) || !Kohana_Upload::valid($value))) {
			$errors[$field] = 'empty';
		} else {
			if (Kohana_Upload::not_empty($value) && Kohana_Upload::valid($value)) {
				if (!Kohana_Upload::type($value, $types)) {
					$errors[$field] = 'type';	
				} else if (!Kohana_Upload::size($value, $maxSize)) {
					$errors[$field] = 'size';	
				}
			}
		}
	}
?>