##################################
### Title: Selection Sort ########
### Author: GuoChen Hou   ########
##################################

# This program sorts the elements in a list in ascending order using bubble sort method.

def bubbleSort(number_list):
	for index in range(len(number_list)):
		for next_index in range(index+1, len(number_list)):
			if number_list[next_index] < number_list[index]:
				number_list[next_index], number_list[index] = number_list[index], number_list[next_index]

number_list = [23,17,5,90,12,44,38,84,77]

bubbleSort(number_list)
print number_list