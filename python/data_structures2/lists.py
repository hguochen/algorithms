"""
This file contains a list of method references for a list
"""

# initiate an empty list
a_list = []

# initiate a list with initial elements
filled_list = [1, 3, 5]

# add an element to the end of the list
a_list.append(1)
a_list.append(2)
a_list.append(3)

# return number of occurences of the value given in paramter
num_of_ones = a_list.count(1)
print "There are %d times of 1 in the list" % num_of_ones

# extne the list by appending all the items in the given list; equivalent to a[len(a):] = L
a_list.extend(filled_list)
print a_list

# return the first index of value.
# if a range start, stop is given, then search in that range
a_list.index(3) # search for 3 in the entire list
#a_list.index(3, 0, 1) # search for element 3 starting from index 0, ending before index 1

# insert an element before the given index
a_list.insert(1, 4) # add 4 to the index at 1, elements after index 1 are all pushed back

# pop an element at the end of the list
# if an index is given, pop the element at that index
a_list.pop() # pop element at end of list
a_list.pop(1) # pop element at index 1

# remove the first occurence of the value
a_list.remove(3)

# reverse the elements in place
a_list.reverse()

# sort a list
a_list.sort() # sort list in ascending order
# sort can take in a first argument comparator, which does 
# cmp(x, y) -> -1, 0, 1
# 
# sort can take in 2nd argument key, which specifies a function called on each list element prior to making comparisons
sorted("This is a test string from Andrew".split(), key=str.lower)
['a', 'Andrew', 'from', 'is', 'string', 'test', 'This']

# the 3rd argument, reverse boolean decides if the list should be sorted in reverse
# a_list(None, None, True)

def more_than_5(item):
    if len(item) > 5:
        return True
    return False

# filter(function, iterable)
# make a result list where the function returns true for the given element in the list.
# note:
# filter(function, iterable) => [item for item in iterable if function(item)] if function is not none
# filter(function, iterable) => [item for item in iterable if item]
result = filter(more_than_5, ["a", "ap", "app", "appl", "apple", "apples", "appless"])
print "result is", result

def multiply_2(number, number_2):
    return number * 2 * number_2

# map(function, iterable)
# make a result lit where the function is applied to every element in the given iterable.
# if more than 1 iterable is given, the function must take in however many arguments as that the number of iterable
multiply_result = map(multiply_2, [1, 2, 3, 4, 5], [3, 5, 7, 9, 11])
print "multiply result is ", multiply_result

# reduce(function, sequence)
# returns a single value constructed by repeatedly calling the function on the sequence elements
# it starts off by calling the first two elements on the sequence, then on the result and the next element and so on.
def add(x, y):
     return x + y
add_result = reduce(add, range(0, 10))
print "add_result is ", add_result

## List comprehensions
# provide a simple way to create lists
# you can use list comprehension when:
# - make new lists each element needs to be manipulated by some functions

# let's say we want to make a list of squared elements:
squares = []
for x in range(10):
    squares.append(x**2)
# is equivalent to:
squares = [x**2 for x in range(10)]

# now let's get unique combinations of 3 list elements
list1 = [1, 2, 3]
list2 = [3, 1, 4]
list3 = [4, 5, 2]

combs = []
for x in list1:
    for y in list2:
        for z in list3:
            if x != y and x != z and y != z:
                combs.append((x, y, z))
print "combs is ", combs
# is equivalent to:
combs2 = [(x, y, z) for x in list1 for y in list2 for z in list3 if x != y and x != z and y != z]
print combs2

# list comprehension examples
list_example = [-4, -2, 0, 2, 4]

# create a new list with the values doubled
list_values_doubled = [x*2 for x in list_example]

# filter the list to exclude negative numbers
positive_list = [x for x in list_example if x >= 0]

# apply a absolute function to all the elements
positive_list2 = [abs(x) for x in list_example]

# call a method on each element
freshfruit = ['   banana', 'loganberry  ', 'passion fruit ']
stripped_frestfruit = [fruit.strip() for fruit in freshfruit]

# create a list of 2-tuples like (number, square)
tuples_2 = [(x, x**2) for x in range(6)]

# flatten a list using listcomp with two 'for'
vec = [[1,2,3], [4,5,6], [7,8,9]]
flat_vec = [num for element in vec for num in element]

# you can loop through a list using enumerate to access its index and the corresponding element
for i, v in enumerate(['tic', 'tac', 'toe']):
    # 0 tic
    # 1 tac
    # 2 toe
    print i, v

# you can loop over two or more sequence at the same time
questions = ['name', 'quest', 'favourite color']
answers = ['lancelot', 'the holy grail', 'blue']
for q, a in zip(questions, answers):
    print 'What is your {0}? It is {1}'.format(q, a)

# to loop over sequence in reverse
for i in reversed(xrange(1, 10, 2)):
    print i
# OR
for i in xrange(10, 1, -2):
    print i
