##################################
### Title: Sort Points    ########
### Author: GuoChen Hou   ########
##################################

# Write a program sort_points.c to read in a positive integer indicating the number of 
# 2-dimensional points, followed by the x- and y-coordinates of those points. These points 
# should be read into an array of structures, where each structure contains the x- and 
# y-coordinates of a point. You should name the structure type point_t.

# You may assume that there are at least 2 points and at most 20 points. You may use only 
# one of these sorting algorithms: Selection sort, Bubble sort, or Insertion sort.

# Your program should then sort the array of points in ascending order of the distance of 
# these points from the origin (0,0).
# The formula to compute the distance of a point (x,y) from the origin (0,0) is given below:
# dist(x,y) = sqrt( x*x + y*y )

import math
from bubble_sort import bubbleSort

numbers = raw_input('Enter points in succession in (x1 y1 x2 y2 ...) order: ')
char_list = list(numbers.split(' '))
number_list = []
for char in char_list:
	num = int(char)
	number_list.append(num)

coord = []
coord_list = []
count = 0
for num in number_list:
	coord.append(num)
	count += 1
	if count == 2:
		coord_list.append(coord)
		coord = []
		count = 0

coord_value = []
for x,y in coord_list:
	dist = math.sqrt(x*x + y*y)
	coord_value.append(dist)

coord_value_mapping = {}
for index in range(len(coord_value)):
	coord_value_mapping[coord_value[index]] = coord_list[index]

bubbleSort(coord_value)
for value in coord_value:
	print coord_value_mapping[value]
