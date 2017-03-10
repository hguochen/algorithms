<?php

// You’re given a read only array of n integers. Find out if any integer occurs
// more than n/3 times in the array in linear time and constant additional space.

// If so, return the integer. If not, return -1.

// If there are multiple solutions, return any one.

// Example :

// Input : [1 2 3 1 1]
// Output : 1 
// 1 occurs 3 times which is more than 5/3 times.

// We will solve for a more general case of this question here.
// Given an array of of size n and a number k, find all elements that appear
// more than n/k times