## PG 153
### Exercise 6.1

6.1.1
if h=1, min and max should both be 1.
For maximum, the lowest level should be full. so the number of nodes should be 2^h - 1 (root only has 1)
For minimum, the lowest level should have 1 item only, 2^(h-1) - 1 + 1 = 2^(h-1)

6.1.2 Show that n element heap has height floor(lg n)

6.1.3 In a max heap, any element that is smaller than root is kept in level order of nodes. If element is bigger than root node, it bubbles up the tree to become the root node.

6.1.4 The smallest element will be at the bottom of the tree but the position will be undeterministic.

6.1.5 Yes. a sorted array is a min heap.

6.1.6 Yes.

6.1.7 - 

## PG 156
### Exercise 6.2

6.2.1
A = {27, 17, 3, 16, 13,10, 1, 5, 7, 12, 4, 8, 9, 0}
max_heapify(A, 2)  # 0 indexed
    left child of 3 is 10, the largest of the 3 values. so 3 swap with 10.
max_heapify(A, 5)
    right child of 3 is 9, the largest of 3 values, so 3 swap with 9.
    since 3 is not a leaf node, terminate.

6.2.2
def min_heapify(a_list, i):
    # left child index
    left = 2 * i
    # right child index
    right = 2*i + 1
    if left < len(a_list) and a_list[left] < a_list[i]:
        if right < len(a_list) and a_list[right] > a_list[i]:
            # right child smallest
            smallest_index = right
        else:  # left child smallest
            smallest_index = left
    if smallest_index != i:
        a_list[i], a_list[smallest_index] = a_list[smallest_index], a_list[i]
        return min_heapify(a_list, smallest_index)
    return a_list
max_heapify and min_heapify will have the same time complexity.

6.2.3
A check is performed to determine that value at index i is largest and returns the list.

6.2.4
What is the effect of calling max-heapify for which part of the tree is evaluated.
heapify is performed from sub tree index i downwards and guarantees that subtree starting from index i is a max heap.

6.2.5
max_heapify_interative(a_list, i)

6.2.6
For a heap of size n which adopts a tree structure. its worst case running time will be O(lg n).