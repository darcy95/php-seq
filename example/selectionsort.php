<?
	include "../class/class_seq.php";

	function selectionsort($s)
	{
		if (Seq::isempty($s))
			return Seq::createseq();
		else
			return Seq::addhead(Seq::minimum($s), selectionsort(Seq::cut(Seq::minimum($s), $s)));
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
	echo "<tr><td>Values of \$s before selectionsort: </td><td>" . Seq::printl($s) . "</td></tr>";
	echo "<tr><td>Values of \$s after selectionsort: </td><td>" . Seq::printl(selectionsort($s)) . "</td></tr>";
	echo "</table>";
?>
