def merge(a_list, start, mid, end):
	result = [-1] * len(a_list)
	curr1 = start # current index to 1st segment of array
	curr2 = mid + 1 # current index to 2nd segment of array
	curr_r = start # current index in the result array

	while curr1 <= mid and curr2 <= end:
		# copy smaller value to result list
		if a_list[curr1] <= a_list[curr2]:
			result[curr_r] = a_list[curr1]
			curr1 += 1
		else:
			result[curr_r] = a_list[curr2]
			curr2 += 1
		curr_r += 1

	while curr1 <= mid:
		result[curr_r] = a_list[curr1]
		curr1 += 1
		curr_r += 1

	while curr2 <= end:
		result[curr_r] = a_list[curr2]
		curr2 += 1
		curr_r += 1

	return result

if __name__ == "__main__":
	num_list = [14,20,36,10,12,30,40,44]
	print merge(num_list, 0, 2, len(num_list)-1)