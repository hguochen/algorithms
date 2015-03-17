## PG 22
### Exercise 2.1

2.1.3

def value_index(array, v):
    index = None
    for i in range(len(array)):
        if item == array[i]:
            index = i
            break
    return index

2.1.4 

def add_binary(list1, list2):
    result = []
    for item1 in list1:
        for item2 in list2:
            result.append(binary_sum(bin(item1), bin(item2)))
    return result

def binary_sum(x, y):
    """
    Take in 2 binary integers in string type and add them.
    Return the added value in binary integer of string type
    """
    return bin(int(x, 2) + int(y, 2))


### Exercise 2.2

2.2.1 
n^3/1000 - 100n^2 - 100n + 3
=> O(n^3)

2.2.2 Consider sorting n numbers stored in array A by first finding the smallest element of A and exchanging it with the element in A[1. Then find the second smallest element of A and exchange it with A[2]. Continue in this manner for the first n - 1 elements of A. Write pesudocode for this algorithm.

def selection sort(array):    
    for i in range(1, len(array)):
        smallest = array[0]
        if array[i] < smallest:
            smallest = array[i]
            j = i - 1
            while j > 0:
                array[j+1] = array[j]
            array[0] = smallest
    return array

Need to run n - 1 because the first element is already sorted.
Loop invariant is from arrat at index 0 to index j.
Best case running time: O(n^2)
Worst case running time: O(n^2)

2.2.3
On average, n/2 items needs to be checked.
Worst case happens when item is at the end of the array, n checks need to be performed.
Average case: O(n)
Worst case: O(n)

2.2.4 We can manipulate the inputs to a desired input such that the algorithm always runs in best case scenairo.