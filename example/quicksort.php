<?
	include "../class/class_seq.php";

	function quicksort($s)
	{
		if (Seq::isempty($s))
		{
			return Seq::createseq();
		}
		else
		{
			$small = Seq::select_smaller(Seq::ft($s), $s);
			$equal = Seq::select_equal(Seq::ft($s), $s);
			$great = Seq::select_greater(Seq::ft($s), $s);
		}

		return Seq::joint(Seq::joint(quicksort($small), $equal), quicksort($great));
	}

	$s = Seq::createseq();
	$s = Seq::addtail($s, 94);
	$s = Seq::addtail($s, 79);
	$s = Seq::addtail($s, 88);
	$s = Seq::addtail($s, 84);
	$s = Seq::addtail($s, 11);
	$s = Seq::addtail($s, 46);
	$s = Seq::addtail($s, 69);
	$s = Seq::addtail($s, 71);
	$s = Seq::addtail($s, 81);
	$s = Seq::addtail($s, 24);
	$s = Seq::addtail($s, 16);
	$s = Seq::addtail($s, 49);
	echo "<br>";
	echo "<table align='center' width='800' cellpadding='5' cellspacing='0' border='1'>";
	echo "<tr><td>Values of \$s before quicksort: </td><td>" . Seq::printl($s) . "</td></tr>";
	echo "<tr><td>Values of \$s after quicksort: </td><td>" . Seq::printl(quicksort($s)) . "</td></tr>";
	echo "</table>";
?>