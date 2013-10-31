##################################
### Title: Bubble Sort    ########
### Author: GuoChen Hou   ########
##################################

# This program sorts the elements in a list in ascending order using bubble sort method.

def bubbleSort(a_list):
	for index in range(len(a_list)):
		for next_index in range(index+1, len(a_list)):
			if a_list[next_index] < a_list[index]:
				a_list[next_index], a_list[index] = a_list[index], a_list[next_index]
				
number_list = [23,17,5,90,12,44,38,84,77]

bubbleSort(number_list)