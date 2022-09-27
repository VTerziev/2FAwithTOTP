<?php
	$TIME_FRAME_LENGTH = 30;

	function getCurrentTimeFrameIndex() {
		$seconds = time();
		global $TIME_FRAME_LENGTH;
		return floor($seconds/$TIME_FRAME_LENGTH);
	}
	
	function generateTOTP($timeFrameIndex, $shared_key) {
		// TODO: is this suitable hash function?
		return hash("sha512", $timeFrameIndex.$shared_key);
	}


	function generateTOTPForNow($shared_key) {
		$timeFrameIndex = getCurrentTimeFrameIndex();
		return generateTOTP($timeFrameIndex, $shared_key);
	}

    function generateCurrentlyValidTOTPS($shared_key) {
		$timeFrameIndex = getCurrentTimeFrameIndex();
		return [generateTOTP($timeFrameIndex, $shared_key), generateTOTP($timeFrameIndex-1, $shared_key)];
	}
?>
