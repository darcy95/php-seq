<?
	function mergesort($s)
	{
		if (Seq::isempty($s))
		{
			return Seq::createseq();
		}
		else
		{
			if (Seq::isatom($s))
			{
				return $s;
			}
			else
			{
				$middle = floor(Seq::count($s) / 2);
				$left = Seq::take($middle, $s);
				$right = Seq::drop($middle, $s);
				return merge(mergesort($left), mergesort($right));
			}
		}
	}

	function merge($s1, $s2)
	{
		if (Seq::isempty($s1))
		{
			if (Seq::isempty($s2))
			{
				return Seq::createseq();
			}
			else
			{
				return $s2;
			}
		}
		else
		{
			if (Seq::isempty($s2))
			{
				return $s1;
			}
			else
			{
				if (Seq::ft($s1) <= Seq::ft($s2))
				{

					return Seq::addhead(Seq::ft($s1), merge(Seq::rt($s1), $s2));
				}
				else
				{
					return Seq::addhead(Seq::ft($s2), merge($s1, Seq::rt($s2)));
				}
			}
		}
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
	echo "<tr><td>Values of \$s before mergesort: </td><td>" . Seq::printl($s) . "</td></tr>";
	echo "<tr><td>Values of \$s after mergesort: </td><td>" . Seq::printl(mergesort($s)) . "</td></tr>";
	echo "</table>";
?>