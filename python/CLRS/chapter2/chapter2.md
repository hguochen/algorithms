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