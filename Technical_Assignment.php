<!DOCTYPE html>
<html>
<body>

	<?php 
	/*1. implement a function closestToZero to return the value closest to zero
	which is supplied via the input array $arrayValues
	- if $arrayValues is empty return 0
	- if two numbers are equally close to zero, consider the positive number
	to be closer to zero
	*/ 
	function closestToZero($arrayValues=array())
	{
	  if(empty($arrayValues))
		return 0;
	  
	  $closest = 0;
	  foreach($arrayValues as $val)
	  {
			if ($closest === 0) {
				$closest = $val;
			} else if ($val > 0 && $val <= abs($closest)) {
				$closest = $val;
			} else if ($val < 0 && -$val < abs($closest)) {
				$closest = $val;
			}	 
	  }
	  return $closest;
	}


	/* test code */
	$input = array(7,-10,13,8,4,-7.2,-12,-3.7,3.5,-9.6,6.5,-1.7,-6.2,7);
	echo "Result " . closestToZero($input);  


	/*- Write three functions that compute the sum of the numbers in a given
	list using a for-loop, a while-loop, and recursion.
	*/ 
	  
	function ForLoop($list)
	  {
		$sum = 0;
		for($i = 0; $i < count($list); $i++)
		{
		  $sum = $sum + $list[$i];
		}
		return $sum;
	  }
	  
	  function WhileLoop($list)
	  {  
		$i = 0;
		$sum = 0;
		while ($i < count($list)):
			$sum = $sum + $list[$i];
			$i++;
		endwhile;  
		return $sum;
	  }

	  function recur($array) {
		  $sum = 0;
		  array_walk_recursive($array, function($v) use (&$sum) {
			  $sum += $v;
		  });
		  return $sum;
	  }

	  $list = [15,3,6,85,4,55,6];

	  echo "for loop =".ForLoop($list);
	  echo "<br>while loop = ".WhileLoop($list);
	  echo "<br>Recursive = ".recur($list); 
 
	/*- Write a function that combines two lists by alternatively taking
	elements. For
	example: given the two lists [a, b, c] and [1, 2, 3], the function should
	return [a, 1, b, 2, c, 3].
	*/
	  
	function combineArrays($arrAlph,$arrNums)
	{
	  $result = []; //declare an empty array
	  for($i = 0; $i < count($arrNums); $i++)
	  {
		array_push($result,$arrAlph[$i]);
		array_push($result,$arrNums[$i]);
	  }
	  return $result;
	}

	$arrAlph = ['a', 'b', 'c']; 
	$arrNums = [1,2,3];
	  
	  
	print_r(combineArrays($arrAlph,$arrNums));   
	  
	?> 
<script>
	/*
	- Write a function that computes the list of the first 100 Fibonacci
	numbers. By definition, the first two numbers in the Fibonacci sequence
	are 0 and 1, and each subsequent number is the sum of the previous two. As
	an example, here are the first 10 Fibonnaci numbers: 0, 1, 1, 2, 3, 5, 8,
	13, 21, and 34.
	*/
	 
	function fibonacciNaive(howMany){
	  // this solution won't really work
	  // because with howMany = 100
	  // we will try to handle bigger numbers
	  // than Number.MAX_SAFE_INTEGER
	  howMany = howMany || 100;
	  var nums = [0,1];
	  while(nums.length < howMany){
		nums.push(nums[nums.length-2] + nums[nums.length-1]);
	  }
	  return nums;
	}

	function fibonacci(howMany){

	  function addBigNums(a,b){
		a = String(a).split('');
		b = String(b).split('');
		var sum = [], mem = 0, part;
		while(a.length || b.length){
		  part = String(
			Number(a.pop() || 0) + Number(b.pop() || 0) +
			Number(mem)
		  ).split('');
		  sum.unshift(part.pop());
		  mem = part.join('');
		}
		sum.unshift(mem);
		return sum.join('');
	  }

	  howMany = howMany || 100;
	  var nums = ["0","1"];
	  while(nums.length < howMany){
		nums.push(
		  addBigNums(nums[nums.length-2],nums[nums.length-1])
		);
	  }
	  return nums; 
	}
</script>

<?php 
	//-  Given array of integers, find the lowest absolute sum of elements. 
	function sumOfMinAbsDifferences($arr, $n) 
	{ 
		  
		// sort the given array 
		sort($arr); 
		sort( $arr,$n); 
		  
		// initialize sum 
		$sum = 0; 
		  
		// min absolute difference for 
		// the 1st array element 
		$sum += abs($arr[0] - $arr[1]); 
		  
		// min absolute difference for 
		// the last array element 
		$sum += abs($arr[$n - 1] - $arr[$n - 2]); 
		  
		// find min absolute difference 
		// for rest of the array elements 
		// and add them to sum 
		for ($i = 1; $i < $n - 1; $i++) 
			$sum += min(abs($arr[$i] - $arr[$i - 1]),  
					   abs($arr[$i] - $arr[$i + 1])); 
			  
		// required sum  
		return $sum;  
	} 
	  
		// Driver Code 
		$arr = array(5, 10, 1, 4, 8, 7); 
		$n = sizeof($arr); 
		echo "Sum = ", sumOfMinAbsDifferences($arr, $n); 
	  
	// This code is contributed by nitin mittal.


/*- Write a program that outputs all possibilities to put + or - or nothing
between the numbers 1, 2, ..., 9 (in this order) such that the result is
always 100. For example: 1 + 2 + 34  5 + 67  8 + 9 = 100.
*/	
?>
<div id="place"></div>
<script>
	 function allPossibilities(){
	 
	  // brute force solution
	 
	  // first calculate all possible combinations
	  // of numbers and operators
	  var mem = ["1"], combos;
	  for(var i = 2; i <= 9; i++){
		combos = [];
		mem.forEach(function(x){
		  combos.push(x + i, x + " +" + i, x + " -" + i);
		});
		mem = combos;
	  }
	 
	  // Now filter out the ones that equal 100
	  return combos.filter(function(combo){
		// split a combo into numbers, sum them using reduce
		return combo.split(" ").reduce(function(x,y){
		  return x/1+y/1;
		}) == 100; // and check if the sum is 100
	  })
	  // format output by adding some spaces
	  .map(function(x){
		return x.replace(/([+-])/g,'$1 ');
	  });
	 
	} 
	  document.getElementById('place').innerHTML =allPossibilities().toString().split(',').join('<br>')
</script>

</body>
</html>



