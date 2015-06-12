# The Fibonacci numbers are defined by recurrence. Give an O(n) time
# dynamic-programming algorithm to compute the nth Fibonacci number. Draw the
# subproblem graph. How many vertices and edges are in the graph?


def fibonacci(num):
    if num == 0:
        return 0
    elif num == 1:
        return 1
    else:
        sequence = [None for _ in xrange(num+1)]
        sequence[0] = 0
        sequence[1] = 1
        for i in xrange(2, num+1):
            sequence[i] = sequence[i-1] + sequence[i-2]
        return sequence[num]

if __name__ == "__main__":
    print fibonacci(0)
    print fibonacci(1)
    print fibonacci(2)
    print fibonacci(3)
    print fibonacci(4)
    print fibonacci(5)
    print fibonacci(6)
    print fibonacci(7)
    print fibonacci(8)
    print fibonacci(9)
    print fibonacci(10)
    print fibonacci(11)
    print fibonacci(12)
    print fibonacci(13)
    print fibonacci(14)
