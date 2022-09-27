<?php
	$ENCRYPTION_KEY = hex2bin("8156d9c498ffba57164597a51151682b0b57e396fc909f07675a92aac642e2545c0169553a2521589efe537ca3198bac61a85e13165ad26bf45a713282b69907e2f76960677ae5ddfeda79c6edb098eac7873c6dddb2b99021c5c11a72108f864d9de89a794b3f0a0d1613e3715fd627a58f14defb818b6f4324b6796ee00c22c9a2304332c1e762be07c04a008a92ea445059f1724c5c4936447c5c779398accfa20c191b8fd9105b4ead006f9a0e6f71f849049d5edd67e16f99ba6d26182ad0ceab68760535a9563e0f444bb7dded55ca543af1d36ab143366a3421c70cb18796213250d523e23dc4b5bfdbca84b840a5f4c60bcff9e44ec034efa9bf6113");
	$CIPHER = "aes-128-cbc";
    $IV = hex2bin("0982e3b712d97f3018cfc45508a37157");

	function encrypt($plaintext) {
        global $ENCRYPTION_KEY, $CIPHER, $IV;
        return openssl_encrypt($plaintext, $CIPHER, $ENCRYPTION_KEY, $options=0, $IV);
	}
	
	function decrypt($cipher_text) {
        global $ENCRYPTION_KEY, $CIPHER, $IV;
        return openssl_decrypt($cipher_text, $CIPHER, $ENCRYPTION_KEY, $options=0, $IV);
	}

?>