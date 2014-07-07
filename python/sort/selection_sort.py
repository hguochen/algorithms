##############################################################################
# Author: GuoChen
# Title: Selection sort
##############################################################################

def selection_sort(a_list):
    """
    Divides the list into two parts: sorted and unsorted. Left sublist
    contains the sorted list of elements, right unsorted. Each time the
    pointer traverses the unsorted part of element, finds the least element
    and place it in the sorted part of the list.
    """

    for i in range(len(a_list)):
        
        # assume min is the first element
        min_index = i

        # test against elements after i to find the smallest element index
        for j in range(i+1, len(a_list)):
            if a_list[j] < a_list[min_index]:
                min_index = j
        
        # swap elements if min_index has changed.
        if min_index is not i:
            a_list[min_index], a_list[i] = a_list[i], a_list[min_index]
    return a_list


if __name__ == "__main__":
    test_list = [64, 25, 12, 22, 11]

    print selection_sort(test_list)
