def insertion_sort(a_list):
    """
    Insertion sort sorts the array 'a_list' by first inserting a[1] into
    the sorted array a[0]. Next inserting a[2] into the before sorted array
    and finally inserting a[n-1] into the sorted array.
    """

    for i in range(1, len(a_list)):
        # save value to be inserted later
        value = a_list[i]
        last_sorted_index = i - 1

        # if value is less than last sorted value, move last_sorted_index
        # right to make room for value.
        while last_sorted_index >= 0 and value < a_list[last_sorted_index]:
            a_list[last_sorted_index+1] = a_list[last_sorted_index]
            last_sorted_index -= 1
        a_list[last_sorted_index+1] = value

    return a_list

if __name__ == "__main__":
    a_list = [23, 65, 76, 2, 1, 54]
    print insertion_sort(a_list)
