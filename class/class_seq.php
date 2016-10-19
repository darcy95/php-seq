<?
/* 
+---------------------------------------------------------------------------------+
|	Class		: class_seq
|	Author		: Juhoon Kim (kimjuhoon@gmail.com)
|	Copyright	: Free
|	Version		: 1.02
|	Last Update : 2006-12-22
|	History		:	(+ added, - removed, * modified)
|
|					2006-12-20  + V1.0 is done 
|
|					2006-12-21	+ minimum()
|								+ isallstr()
|								+ isallnum()
|								+ isallbool()
|								+ ispure()
|								+ rem()
|								+ inseq()
|								+ diff()
|								- Error definitions
|
|					2006-12-22  + isunique()
|								+ isequal()
|								+ inter()
|
|					2007-01-09  + cut()
|								* maximum()
|								* minimum()
|
|					2007-01-10  * revert()
|								* joint()
|
|					2007-01-11	+ rrt()
|
|					2007-01-12	+ insert()
|
|					2007-02-07	+ range()
|
|					2007-05-23	* isempty()			: == -> ===
|
+---------------------------------------------------------------------------------+
*/

class Seq
{
	// +--------------------------------------------------------------------------+
	// | isempty : seq -> bool
	// +--------------------------------------------------------------------------+
    // check if a given seq is empty or not
	function isempty($seq)
	{
		return Seq::ft($seq) === null;
	}

	// +--------------------------------------------------------------------------+
	// | isatom : seq -> bool
	// +--------------------------------------------------------------------------+
    // check if a given seq contains only one element
	function isatom($seq)
	{
		return Seq::count(Seq::addhead(Seq::ft($seq),Seq::createseq())) & Seq::isempty(Seq::rt($seq));
	}

	// +--------------------------------------------------------------------------+
	// | count : seq -> nat
	// +--------------------------------------------------------------------------+
    // return the number of elements in a given seq
	function count($seq)
	{
		return Seq::isempty($seq) ? 0 : 1 + Seq::count(Seq::rt($seq));
	}

	// +--------------------------------------------------------------------------+
	// | createseq : seq
	// +--------------------------------------------------------------------------+
    // create an empty seq
	function createseq()
	{
		return array();
	}

	// +--------------------------------------------------------------------------+
	// | revert : seq -> seq
	// +--------------------------------------------------------------------------+
    // return a reverted seq
	function revert($seq)
	{
		if (Seq::isempty($seq))
		{
			return Seq::createseq();
		}
		else
		{
			return Seq::addtail(Seq::revert(Seq::rt($seq)), Seq::ft($seq));
		}

//		return (Seq::isempty($seq)) ? Seq::createseq() : Seq::addtail(Seq::revert(Seq::rt($seq)), Seq::ft($seq));
	}

	// +--------------------------------------------------------------------------+
	// | ft : seq -> data
	// +--------------------------------------------------------------------------+
    // return an element at the end of a given seq
	function ft($seq)
	{
		return array_shift($seq);
	}

	// +--------------------------------------------------------------------------+
	// | rt : seq -> seq
	// +--------------------------------------------------------------------------+
    // return a remaining seq after taking out the head element from a given seq
	function rt($seq)
	{
		array_shift($seq);
		return $seq;
	}

	// +--------------------------------------------------------------------------+
	// | tl : seq -> data
	// +--------------------------------------------------------------------------+
    // return a tail element of a given seq
	function tl($seq)
	{
		return array_pop($seq);
	}

	// +--------------------------------------------------------------------------+
	// | rrt : seq -> seq
	// +--------------------------------------------------------------------------+
    // return a remaining seq after taking out the taile element from a given seq
	function rrt($seq)
	{
		return Seq::revert(Seq::rt(Seq::revert($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | kth : nat x seq -> data					{k | 0 <= k <= count(seq)}
	// +--------------------------------------------------------------------------+
    // return k-th element from a given seq
	function kth($k, $seq)
	{
		return ($k > 0) ? Seq::kth($k - 1, Seq::rt($seq)) : Seq::ft($seq);
	}

	// +--------------------------------------------------------------------------+
	// | kth_smallest : nat x seq -> data			{k | 1 <= k <= count(seq)}
	// +--------------------------------------------------------------------------+
    // return the k-th smallest element from a given seq
	function kth_smallest($k, $seq)
	{
		if (Seq::isempty($seq))
		{
			return NULL;
		}
		else
		{
			$sGroup = Seq::select_smaller(Seq::ft($seq), Seq::rt($seq));
			$gGroup = Seq::select_greater(Seq::ft($seq), Seq::rt($seq));
			$index  = Seq::count($sGroup) + 1;

			if ($k < $index) 
			{
				return Seq::kth_smallest($k, $sGroup);
			}
			else if ($k == $index)
			{
				return Seq::ft($seq);
			}
			else
			{
				return Seq::kth_smallest($k - $index, $gGroup);
			}
		}
	}

	// +--------------------------------------------------------------------------+
	// | kth_biggest : nat x seq -> data			{k | 1 <= k <= count(seq)}
	// +--------------------------------------------------------------------------+
    // return a k-th greatest element from a given element
	function kth_biggest($k, $seq)
	{
		return Seq::kth_smallest((Seq::count($seq) + 1) - $k, $seq);
	}

	// +--------------------------------------------------------------------------+
	// | addhead : data x seq -> seq
	// +--------------------------------------------------------------------------+
    // insert an element into the head of a given seq
	function addhead($element, $seq)
	{
		array_unshift($seq, $element);
		return $seq;
	}

	// +--------------------------------------------------------------------------+
	// | addtail : seq x data -> seq
	// +--------------------------------------------------------------------------+
    // insert an element into the tail of a given seq 
	function addtail($seq, $element)
	{
		array_push($seq, $element);
		return $seq;
	}

	// +--------------------------------------------------------------------------+
	// | insert : data x nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// insert data into the position k of seq
	function insert($data, $k, $seq)
	{
		return (Seq::count($seq) < $k) ? Seq::addtail($seq, $data) : Seq::joint(Seq::addtail(Seq::take($k - 1, $seq), $data), Seq::drop($k - 1, $seq));
	}

	// +--------------------------------------------------------------------------+
	// | joint : seq x seq -> seq
	// +--------------------------------------------------------------------------+
	// merge two seqs
	function joint($seq1, $seq2)
	{
		return (Seq::isempty($seq2)) ? $seq1 : Seq::joint(Seq::addtail($seq1, Seq::ft($seq2)), Seq::rt($seq2));
	}

	// +--------------------------------------------------------------------------+
	// | maximum : seq[num] -> num
	// +--------------------------------------------------------------------------+
	// find the biggest number in a seq
	function maximum($seq)
	{
		return (Seq::isatom($seq)) ? Seq::ft($seq) : ((Seq::ft($seq) > Seq::ft(Seq::rt($seq))) ? Seq::maximum(Seq::addhead(Seq::ft($seq), Seq::rt(Seq::rt($seq)))) : Seq::maximum(Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | minimum : seq[num] -> num
	// +--------------------------------------------------------------------------+
	// find the smallest number in a seq
	function minimum($seq)
	{		
		return (Seq::isatom($seq)) ? Seq::ft($seq) : ((Seq::ft($seq) < Seq::ft(Seq::rt($seq))) ? Seq::minimum(Seq::addhead(Seq::ft($seq), Seq::rt(Seq::rt($seq)))) : Seq::minimum(Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | take : nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq which contains elements from 0 to n of a given seq
	function take($n, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : (($n > 0) ? Seq::addhead(Seq::ft($seq), Seq::take($n - 1, Seq::rt($seq))) : Seq::createseq());
	}

	// +--------------------------------------------------------------------------+
	// | drop : nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq which contains elements from n to the end of a given seq
	function drop($n, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : (($n > 0) ? Seq::drop($n - 1, Seq::rt($seq)) : $seq);
	}

	// +--------------------------------------------------------------------------+
	// | select_smaller : nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq which contains smaller elements than k in a given seq
	function select_smaller($k, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : ((Seq::ft($seq) < $k) ? Seq::addhead(Seq::ft($seq), Seq::select_smaller($k, Seq::rt($seq))) : Seq::select_smaller($k, Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | select_greater : nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq which contains greater elements than k in a given seq
	function select_greater($k, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : ((Seq::ft($seq) > $k) ? Seq::addhead(Seq::ft($seq), Seq::select_greater($k, Seq::rt($seq))) : Seq::select_greater($k, Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | select_equal : nat x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq which contains elements equal to k from a given seq
	function select_equal($k, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : ((Seq::ft($seq) == $k) ? Seq::addhead(Seq::ft($seq), Seq::select_equal($k, Seq::rt($seq))) : Seq::select_equal($k, Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | ispure : seq[num] -> bool
	// +--------------------------------------------------------------------------+
	//	check if all elements within a give seq are the same data types (boolean, number, or string)
	function ispure($seq)
	{
		return Seq::isallbool($seq) | Seq::isallnum($seq) | Seq::isallstr($seq);
	}

	// +--------------------------------------------------------------------------+
	// | isallbool : seq[num] -> bool
	// +--------------------------------------------------------------------------+
	function isallbool($seq)
	{
		return (Seq::isempty($seq)) ? true : ((is_bool(Seq::ft($seq))) ? Seq::isallbool(Seq::rt($seq)) : false);
	}

	// +--------------------------------------------------------------------------+
	// | isallnum : seq[num] -> bool
	// +--------------------------------------------------------------------------+
	function isallnum($seq)
	{
		return (Seq::isempty($seq)) ? true : ((is_numeric(Seq::ft($seq))) ? Seq::isallnum(Seq::rt($seq)) : false);
	}

	// +--------------------------------------------------------------------------+
	// | isallstr : seq[num] -> bool
	// +--------------------------------------------------------------------------+
	function isallstr($seq)
	{
		return (Seq::isempty($seq)) ? true : ((is_string(Seq::ft($seq))) ? Seq::isallstr(Seq::rt($seq)) : false);
	}

	// +--------------------------------------------------------------------------+
	// | isunique : seq -> bool
	// +--------------------------------------------------------------------------+
	//	check if all elements appear only once in a given seq
	function isunique($seq)
	{
		return (Seq::isempty($seq)) ? true : ((Seq::inseq(Seq::ft($seq), Seq::rt($seq))) ? false : Seq::isunique(Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | isequal : seq x seq -> bool
	// +--------------------------------------------------------------------------+
	//	check if all elements in the two seqs are identical
	function isequal($seq1, $seq2)
	{
		return (Seq::isempty($seq1) & Seq::isempty($seq1)) ? true : ((Seq::ft($seq1) == Seq::ft($seq2)) ? Seq::isequal(Seq::rt($seq1),Seq::rt($seq2)) : false);
	}

	// +--------------------------------------------------------------------------+
	// | rem : data x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq after removing ALL $element from a given seq
	function rem($element, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : (($element == Seq::ft($seq)) ? Seq::rem($element, Seq::rt($seq)) : Seq::addhead(Seq::ft($seq), Seq::rem($element, Seq::rt($seq))));
	}

	// +--------------------------------------------------------------------------+
	// | cut : data x seq -> seq
	// +--------------------------------------------------------------------------+
	// return a new seq after removing ONE $element from a given seq
	function cut($element, $seq)
	{
		return (Seq::isempty($seq)) ? Seq::createseq() : (($element == Seq::ft($seq)) ? Seq::rt($seq) : Seq::addhead(Seq::ft($seq), Seq::cut($element, Seq::rt($seq))));
	}

	// +--------------------------------------------------------------------------+
	// | inseq : data x seq -> bool
	// +--------------------------------------------------------------------------+
	// check if $element is in a given seq
	function inseq($element, $seq)
	{
		return (Seq::isempty($seq)) ? false : (($element == Seq::ft($seq)) ? true : Seq::inseq($element, Seq::rt($seq)));
	}

	// +--------------------------------------------------------------------------+
	// | inter : seq x seq -> seq
	// +--------------------------------------------------------------------------+
	//	return a new seq which includes common elements of $seq1 and $seq2
	function inter($seq1, $seq2)
	{
		return (Seq::isempty($seq1)) ? Seq::createseq() : ((Seq::inseq(Seq::ft($seq1), $seq2)) ? Seq::addhead(Seq::ft($seq1),Seq::inter(Seq::rt($seq1), $seq2)) : Seq::inter(Seq::rt($seq1), $seq2));
	}

	// +--------------------------------------------------------------------------+
	// | diff : seq x seq -> seq
	// +--------------------------------------------------------------------------+
    // return a new seq which contains elements of $seq1, but not of $seq2
	function diff($seq1, $seq2)
	{
		return (Seq::isempty($seq1)) ? Seq::createseq() : ((Seq::inseq(Seq::ft($seq1), $seq2)) ? Seq::diff(Seq::rt($seq1), $seq2) : Seq::addhead(Seq::ft($seq1), Seq::diff(Seq::rt($seq1), $seq2)));
	}

	// +--------------------------------------------------------------------------+
	// | range : nat x nat -> seq
	// +--------------------------------------------------------------------------+
	//	return a seq which includes natural numbers from $start to $end
	function range($start, $end)
	{
		return ($end < $start) ? Seq::range($end, $start) : (($start == $end) ? Seq::addhead($start, Seq::createseq()) : Seq::addhead($start, Seq::range($start + 1, $end)));
	}

	// +--------------------------------------------------------------------------+
	// | prints : seq -> output
	// +--------------------------------------------------------------------------+
	function prints($seq)
	{
		echo "<pre>"; print_r($seq); echo "</pre>";
	}

	// +--------------------------------------------------------------------------+
	// | printl : seq -> string
	// +--------------------------------------------------------------------------+
	function printl($seq)
	{
		return (Seq::isempty($seq)) ? "" : "[" . Seq::ft($seq) . "] " . Seq::printl(Seq::rt($seq));
	}
}
?>
