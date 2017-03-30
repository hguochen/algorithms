<?php

// N number of books are given. 
// The ith book has Pi number of pages. 
// You have to allocate books to M number of students so that maximum number of pages alloted to a student is minimum. A book will be allocated to exactly one student. Each student has to be allocated at least one book. Allotment should be in contiguous order, for example: A student cannot be allocated book 1 and book 3, skipping book 2.

// NOTE: Return -1 if a valid assignment is not possible

// Input:
//  List of Books M number of students 

// Your function should return an integer corresponding to the minimum number.

// Example:

// P : [12, 34, 67, 90]
// M : 2

// Output : 113

// There are 2 number of students. Books can be distributed in following fashion : 
//   1) [12] and [34, 67, 90]
//       Max number of pages is allocated to student 2 with 34 + 67 + 90 = 191 pages
//   2) [12, 34] and [67, 90]
//       Max number of pages is allocated to student 2 with 67 + 90 = 157 pages 
//   3) [12, 34, 67] and [90]
//       Max number of pages is allocated to student 1 with 12 + 34 + 67 = 113 pages

// Of the 3 cases, Option 3 has the minimum pages = 113. 

/**
 * Use binary search approach to find the minimum pages.
 * 1. To start, we choose the mid number of pages and find out if its possible to
 * allocate students with this min pages.
 * 2. if possible, we store the current pages in result, reduce the num of pages
 * to a smaller range and try to find a better answer.
 * 3. at the end, we return the smallest number of pages found.
 *
 * Time: O(nlogm) where n is the size of array, m is the max sum value
 * Space: O(1)
 */
function allocatePages($arr, $students) {
    if (empty($arr) || sizeof($arr) < $students) {
        return -1;
    }

    list($start, $end) = [0, array_sum($arr)];
    $result = PHP_INT_MAX;

    while ($start <= $end) {
        $mid = floor(($start + $end) / 2);
        if (isPossible($arr, $students, $mid)) {
            $result = min($result, $mid);
            $end = $mid - 1;
        } else {
            $start = $mid + 1;
        }
    }
    return $result;
}

/**
 * Here we try to find out if its possible to partition the books by having the
 * current minimum number of pages set.
 * 1. loop through the books array
 * 2. if current book pages is already bigger than the current min pages, its not
 * possible to allocate the current min pages. return false
 * 3. if up to current book pages is bigger than current min pages, we partition
 * the book to its previous book. we do this by setting the curr_sum value to start
 * from current page value.
 * 4. if current sum is not bigger than the min pages, this book will be allocated
 * to 1 student, along with the previous books. we add this books pages to current sum.
 *
 * Time: O(n) where n is size of books array
 * Space: O(1)
 */
function isPossible($arr, $students, $currMin) {
    $studentsRequired = 1;
    $currSum = 0;

    // loop through the array to find the parition where each student is allocated a book.
    for ($i=0; $i < sizeof($arr); $i++) { 
        if ($arr[$i] > $currMin) {
            return False;
        }
        if ($currSum + $arr[$i] > $currMin) {
            $studentsRequired++;
            $currSum = $arr[$i];
            if ($studentsRequired > $students) {
                return False;
            }
        } else {
            $currSum += $arr[$i];
        }
    }
    return True;
}

$arr1 = [12,34,67,90];
$arr2 = [ 73, 58, 30, 72, 44, 78, 23, 9 ];

echo allocatePages($arr1, 2) . PHP_EOL;
echo allocatePages($arr2, 5) . PHP_EOL;