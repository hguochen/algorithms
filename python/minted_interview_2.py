"""
input:
List 1: [4, 10, 15, 24, 26]
List 2: [0, 9, 12, 20]
List 3: [5, 18, 22, 30]

# size of each list? 10,000
# each list have at least 1 item
output: [20,24] <-- diff of 4

Given K sorted lists, find the smallest range that includes at least 1 number
from each list

"""

# find the smallest range for 2 sorted lists.
# List 1: [4, 10, 15, 24, 26]
# List 2: [0, 9, 12, 20]


def smallest_range(list1, list2):
    # check that both lists are not none
    if len(list1) < 1 or len(list2) < 1:
        return
    # initialize a list to store all the least ranges
    lesser = []
    # get the contributor for each lesser values
    contributor = []
    # iterate through the 2 lists and find the list of lesser values and their
    # corresponding contributors
    for i in range(len(list2)):
        # initialize current list to store ranges between each list2 item and
        # each list1 item
        current = []
        # initalize values list to store their corresponding values that
        # contributes to this range
        values = []
        for j in range(len(list1)):
            # put the result of the comparison in each of the 2 lists
            current.append(abs(list2[i]-list1[j]))
            values.append([list2[i], list1[j]])
        # find the least range value among the current list and append to
        # lesser values
        lesser.append(min(current))
        # find the contributing values that makes up this lesser value and
        # append to contributor list
        for i in range(len(current)):
            if current[i] == min(current):
                contributor.append(values[i])
                break
    # initialize the result items
    least = lesser[0]
    result = contributor[0]
    # find the result least value and its corresponding result values
    for i in range(len(lesser)):
        if lesser[i] < least:
            least = lesser[i]
            result = contributor[i]
    print least
    return result

if __name__ == "__main__":
    list1 = [4, 10, 15, 24, 26]
    list2 = [0, 9, 12, 20]
    list3 = [5, 18, 22, 30]
    list4 = [1, 2, 3, 80]
    list5 = [1, 2, 3, 90, 200]
    list6 = [1, 2, 3, 99, 300]
    print smallest_range(list1, list2)
    print smallest_range(list2, list3)
    print smallest_range(list1, list3)    
    print smallest_range(list4, list5)    
    print smallest_range(list4, list6)    
    print smallest_range(list5, list6)    