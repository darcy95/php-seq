<!DOCTYPE HTML>
<html>
<head>
<title>PHP-SEQ: FPL(Functional Programming Language)-like linear data structure in PHP</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<h1 class="display-4">PHP-SEQ</h1>
	<h1><small class="text-muted">Merge Sort Example</small></h1>
<?
	include "../class/class_seq.php";

	function mergesort($s)
	{
		if (Seq::isempty($s))
			return Seq::createseq();
		else
		{
			if (Seq::isatom($s))
				return $s;
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
				return Seq::createseq();
			else
				return $s2;
		}
		else
		{
			if (Seq::isempty($s2))
				return $s1;
			else
			{
				if (Seq::ft($s1) <= Seq::ft($s2))
					return Seq::addhead(Seq::ft($s1), merge(Seq::rt($s1), $s2));
				else
					return Seq::addhead(Seq::ft($s2), merge($s1, Seq::rt($s2)));
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
?>
	<div style="height:20px"></div>
	<div class="row">
		<div class="col-5">
<pre>
<h3><u>Normal merge sort</u></h3>
// code from https://www.codexpedia.com/php/merge-sort-example-in-php/

function mergesort($s)
{
    if (count($s) == 1 ) return $s;
 
    $m = count($s) / 2;
    $l = array_slice($s, 0, $m);
    $r = array_slice($s, $m);
 
    $l = mergesort($l);
    $r = mergesort($r);
     
    return merge($l, $r);
}
 
function merge($l, $r)
{
    $result = array();
    $leftIndex = 0;
    $rightIndex = 0;
 
    while ($leftIndex < count($l) && $rightIndex < count($r))
    {
        if ($l[$leftIndex] > $r[$rightIndex])
        {
            $result[] = $r[$rightIndex];
            $rightIndex++;
        }
        else
        {
            $result[] = $l[$leftIndex];
            $leftIndex++;
        }
    }

    while ($leftIndex<count($l))
    {
        $result[] = $l[$leftIndex];
        $leftIndex++;
    }
    while ($rightIndex < count($r))
    {
        $result[] = $r[$rightIndex];
        $rightIndex++;
    }

    return $result;
}
</pre>
		</div>
		<div class="col-7">
<pre>
<h3><u>Using php-seq</u></h3>
include "../class/class_seq.php";

function mergesort($s)
{
	if (Seq::isempty($s)) return Seq::createseq();
	else
	{
		if (Seq::isatom($s))
			return $s;
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
			return Seq::createseq();
		else
			return $s2;
	}
	else
	{
		if (Seq::isempty($s2)) return $s1;
		else
		{
			if (Seq::ft($s1) <= Seq::ft($s2)) 
				return Seq::addhead(Seq::ft($s1), merge(Seq::rt($s1), $s2));
			else
				return Seq::addhead(Seq::ft($s2), merge($s1, Seq::rt($s2)));
		}
	}
}
</pre>
		</div>
	</div>
	<div>
		<dl class="row">
			<dt class="col-sm-3">Values of $s before mergesort:</dt>
			<dd class="col-sm-9"><?=Seq::printl($s);?></dd>
			<dt class="col-sm-3">Values of $s after mergesort:</dt>
			<dd class="col-sm-9"><?=Seq::printl(mergesort($s));?></dd>
		</dl>
	</div>	
	<div style="height:30px;"></div>
	<div style="text-align:center;"><a href="/" class="btn btn-info btn-lg active" role="button" aria-pressed="true">Home</a></div>
	<div style="height:100px;"></div>
<div>
</body>
</html>
