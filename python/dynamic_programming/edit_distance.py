# Problem: Given two strings of size m, n and set of operations replace (R),
# insert (I) and delete (D) all at equal cost. Find minimum number of edits
# (operations) required to convert one string into another.
# Example: Given strings SUNDAY and SATURDAY. We want to convert SUNDAY into
# SATURDAY with minimum edits.

# static variables
REPLACE = 0
INSERT = 1
DELETE = 2


def edit_distance_recursive(string1, string2):
    # base cases
    if len(string1) == 0 and len(string2) == 0:
        return 0
    if len(string1) == 0:
        return len(string2)
    if len(string2) == 0:
        return len(string1)
    # replace a char in string1, DP[i+1, j+1] + cost to replace
    replace = edit_distance_recursive(string1[1:], string2[1:]) + REPLACE
    # insert a char in string1, DP[i, j+1] + cost to insert
    insert = edit_distance_recursive(string1, string2[1:]) + INSERT
    # delete a char in string1, DP[i+1, j] + cost to delete
    delete = edit_distance_recursive(string1[1:], string2) + DELETE

    return min(replace, insert, delete)


def edit_distance_dp(string1, string2):
    # construct 2d array
    array = [[-1 for i in xrange(len(string1))] for j in xrange(len(string2))]
    for i in array:
        print i
    # initialize 2d array
    for i in xrange(len(array[0])):
        array[0][i] = i
    for j in xrange(len(array)):
        array[j][0] = j
    for i in array:
        print i
    # fill in 2d array row by row
    for i in xrange(1, len(string2)):
        for j in xrange(1, len(string1)):
            if string1[j] == string2[i]:
                array[i][j] = array[i-1][j-1]
            else:
                array[i][j] = min(array[i][j-1], array[i-1][j-1], array[i-1][j]) + 1
    for i in array:
        print i
    return array[len(string2)-1][len(string1)-1]


if __name__ == "__main__":
    test1 = "SUNDAY"
    test2 = "SATURDAY"
    print edit_distance_recursive(test1, test2)
    print edit_distance_dp(test1, test2)
