<?php

	function sapin($nbr) {
		static $spaces = 0;
		static $count = 0;
		static $stars = 1;
		static $current_nbr = 1;
		static $lines = 0;
		if ($nbr === 0) {
			return;
		}
		if ($count === 0) {
			$spaces = get_spaces($nbr);
			$count++;
		}
		sapin_helper($spaces, $stars, $lines, $current_nbr, $nbr);
		$tronc_spaces = get_spaces($nbr) - floor($nbr / 2);
		tronc_displayer($count, $tronc_spaces, $nbr);
	}

	if (isset($argv[1])) {
		sapin(intval($argv[1]));
	}

	function get_spaces($nbr) {
		$spaces = 3 * $nbr;
		$i = 0;
		$j = 0;
		while ($i < $nbr) {
			if ($i % 2 === 0) {
				$j++;
			}
			$i++;
		}
		$spaces += $j * (0 + floor($nbr/2)) - floor($nbr/2);
		return $spaces;
	}

	function tronc_displayer(&$count, $tronc_spaces, $nbr) {
		$j = 0;
		if ($count === 1) {
			while ($j < $nbr) {
				$i = 0;
				while ($i < $tronc_spaces) {
					echo " ";
					$i++;
				}
				$i = 0;
				while ($i < ($nbr % 2 === 0 ? $nbr + 1 : $nbr)) {
					echo "|";
					$i++;
				}
				echo "\n";
				$j++;
			}
			$count++;
		}
	}

	function sapin_helper(&$spaces, &$stars, &$lines, &$current_nbr, $nbr) {
		$i = 0;
		while ($i < $spaces) {
			echo " ";
			$i++;
		}
		$i = 0;
		while ($i < $stars) {
			echo "*";
			$i++;
		}
		echo "\n";
		$lines++;
		if ($lines === $current_nbr + 3 && $spaces > 0) {
			$spaces += ceil($current_nbr / 2);
			$stars -= ceil($current_nbr / 2) * 2;
			$lines = 0;
			$current_nbr++;
		} else {
			$spaces -= 1;
			$stars += 2;
		}
		if ($spaces >= 0) {
			sapin($nbr);
		}
	}

?>