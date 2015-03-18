# Merge sort
# Avg time complexity: O(nlog n)
# Best time comlexity: O(nlog n)
# Worst time complexity: O(nlog n)
# Space complexity: O(n) if data structure is array. Constant space if data
# structure is linked list.
#
# The key operation of the merge sort algoirthm is the merging of two sorted
# sequences in the "combine" step in divide and conquer approach.
# We break down the array structure in sub arrays and sort them. In its
# simplist sub-array form, each sub-array has only 1 item, which is by itself
# sorted. Then join 2 sub-arrays into a 'greater' sub-array by retrieving the
# elements in ascending order from each of the 2 sub-array. Repeat this until
# the there are no sub-arrays left.


def merge(li, start, mid, end):
    left_li = []
    left_li.extend(li[start:mid+1])
    right_li = []
    right_li.extend(li[mid+1:end+1])
    left_li.append(2147483647)
    right_li.append(2147483647)
    i = 0
    j = 0
    for k in range(start, end+1):
        if left_li[i] <= right_li[j]:
            li[k] = left_li[i]
            i += 1
        else:
            li[k] = right_li[j]
            j += 1


def merge_sort(li, start, end):
    if start < end:
        mid = (start + end) / 2
        merge_sort(li, start, mid)
        merge_sort(li, mid+1, end)
        merge(li, start, mid, end)


if __name__ == "__main__":
    test_list1 = [5, 2, 4, 6, 1, 3, 0]
    merge_sort(test_list1, 0, len(test_list1)-1)
    print test_list1
