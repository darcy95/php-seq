# php-seq

php-seq is a Functional-Programming-Language-like linear data structure written
in PHP. I am a fan of FPL (Functional Programming Language) ever since I
learned OPAL in the university. This is a fun project to get some feel for an
FPL in PHP. If you want to know about the beauty of FPL, check following sort
examples. 

# Usage examples

	include "../class/class_seq.php";
    // ==================================================================================
    // Insertion sort
    // ==================================================================================

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




    // ==================================================================================
    // Merge sort
    // ==================================================================================
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
				if (Seq::ft($s1) <= Seq::ft($s2))
					return Seq::addhead(Seq::ft($s1), merge(Seq::rt($s1), $s2));
				else
					return Seq::addhead(Seq::ft($s2), merge($s1, Seq::rt($s2)));
			}
		}
	}
	
	
	
	
    // ==================================================================================
    // Selection sort
    // ==================================================================================
	function selectionsort($s)
	{
		if (Seq::isempty($s))
			return Seq::createseq();
		else
			return Seq::addhead(Seq::minimum($s), selectionsort(Seq::cut(Seq::minimum($s), $s)));
	}
	
	
	
	
    // ==================================================================================
    // Quick sort
    // ==================================================================================
	function quicksort($s)
	{
		if (Seq::isempty($s))
			return Seq::createseq();
		else
		{
			$small = Seq::select_smaller(Seq::ft($s), $s);
			$equal = Seq::select_equal(Seq::ft($s), $s);
			$great = Seq::select_greater(Seq::ft($s), $s);
		}

		return Seq::joint(Seq::joint(quicksort($small), $equal), quicksort($great));
	}
