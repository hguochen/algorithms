def insertion_sort(a_list):
	for i in range(1, len(a_list)):
		temp = a_list[i]
		current = i - 1
		while current >= 0 and temp < a_list[current]: # current iterates until the first sorted element
			a_list[current+1] = a_list[current]
			current -= 1
		a_list[current+1] = temp
	return a_list
	

if __name__ == "__main__":
	apple = [36,14,27,40,31]
	print insertion_sort(apple)