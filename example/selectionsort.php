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
	<h1><small class="text-muted">Selection Sort Example</small></h1>
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
?>
	<div style="height:20px"></div>
	<div class="row">
		<div class="col-5">
<pre>
<h3><u>Normal selection sort</u></h3>
// code from https://www.codexpedia.com/php/php-selection-sort-implementation/

function selectionSort($s)
{
    $n = count($s);
    $nextSwap = null;
    $temp = null;
 
    for ($i = 0 ; $i < $n - 1 ; $i++)
    { 
        $nextSwap = $i;

        for ($j = $i + 1 ; $j < $n; $j++)
        {
            if ($s[$j] < $s[$nextSwap])
            {
                $nextSwap=$j; 
            }
        }
 
        $temp = $s[$i];
        $s[$i] = $s[$nextSwap];
        $s[$nextSwap] = $temp;
    }
 
    return $s;
}
</pre>
		</div>
		<div class="col-7">
<pre>
<h3><u>Using php-seq</u></h3>
include "../class/class_seq.php";

function selectionsort($s)
{
	if (Seq::isempty($s))
		return Seq::createseq();
	else
		return Seq::addhead(Seq::minimum($s), selectionsort(Seq::cut(Seq::minimum($s), $s)));
}
</pre>
		</div>
	</div>
	<div>
		<dl class="row">
			<dt class="col-sm-3">Values of $s before selectionsort:</dt>
			<dd class="col-sm-9"><?=Seq::printl($s);?></dd>
			<dt class="col-sm-3">Values of $s after selectionsort:</dt>
			<dd class="col-sm-9"><?=Seq::printl(selectionsort($s));?></dd>
		</dl>
	</div>
	<div style="height:30px;"></div>
	<div style="text-align:center;"><a href="/" class="btn btn-info btn-lg active" role="button" aria-pressed="true">Home</a></div>
	<div style="height:100px;"></div>
</div>

</body>
</html>
