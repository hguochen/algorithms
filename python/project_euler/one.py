# http://projecteuler.net/problem=1
# Multiples of 3 and 5
# If we list all the natural numbers below 10 that are multiples of 3 or 5, we
# get 3, 5, 6 and 9. The sum of these multiples is 23. Find the sum of all the
# multiples of 3 or 5 below 1000.


def sum_of_three_fives(num):
    result = 0
    for i in xrange(1, num):
        if i % 15 == 0 or i % 3 == 0 or i % 5 == 0:
            result += i
    return result


if __name__ == "__main__":
    print sum_of_three_fives(1000)
