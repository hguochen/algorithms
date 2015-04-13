# max_heapify assumes that the binary trees rooted at left(i) and right(i) are
# max-heaps, but that A[i] might be smaller than its children, thus violating
# the max-heap property. max_heapify lets the value at A[i] "float down" in
# the max-heap so that the subtree rooted at index i obeys the max-heap
# property.
# parent -> floor(i/2)
# left -> 2*i
# right -> 2 * i + 1


def max_heapify(a_list, i):
    # left child index
    left = 2 * i
    # right child index
    right = 2*i + 1
    if left < len(a_list) and a_list[left] > a_list[i]:
        largest_index = left
    if right < len(a_list) and a_list[right] > a_list[i]:
        # right child largest
        largest_index = right
    if largest_index != i:
        a_list[i], a_list[largest_index] = a_list[largest_index], a_list[i]
        return max_heapify(a_list, largest_index)
    return a_list


def max_heapify_iterative(a_list, i):
    """
    Heapify iterative solution

    """
    # terminating condition: index is more less than heap size
    left = 2 * i
    right = 2*i + 1

    while i < len(a_list):
        if a_list[right] > a_list[i]:
            largest_index = right
        elif a_list[left] > a_list[i]:
            largest_index = left

        if largest_index != i:
            a_list[i], a_list[largest_index] = a_list[largest_index], a_list[i]
            i = largest_index
    return a_list
