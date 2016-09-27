<?
	include "../class/class_seq.php";

	function insertsort($s)
	{
		if (Seq::isempty($s))
			return Seq::createseq();
		else
			return insert(Seq::ft($s), insertsort(Seq::rt($s)));
	}

	function insert($el, $s)
	{
		if (Seq::isempty($s))
			return Seq::addhead($el, Seq::createseq());
		else
			return ($el <= Seq::ft($s)) ? Seq::addhead($el, $s) : Seq::addhead(Seq::ft($s), insert($el, Seq::rt($s)));
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
	echo "<tr><td>Values of \$s before insertsort: </td><td>" . Seq::printl($s) . "</td></tr>";
	echo "<tr><td>Values of \$s after insertsort: </td><td>" . Seq::printl(insertsort($s)) . "</td></tr>";
	echo "</table>";
?>
