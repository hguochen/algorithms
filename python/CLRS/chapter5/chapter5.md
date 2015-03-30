## PG 117
### Exercise 5.1

5.1.1
For every successive candidate, we check if the candidate is more qualified and replace it as the best candidate if positive.

5.1.2
A call to random(0,1) returns an integer between 0 and 1 with 0 having probability 1/2 and 1 having probability 1/2. To determine the running time, we take expectation of the running time over the distribution of values returned by the random number. function: exp / (b-a+1)

5.1.3
Set a global flag to indicate the return value.

zero = True
def unbiased_random(0,1):
    if biased_random == 0 and zero:
        zero = False
        return 0
    elif biased_random == 0 and not zero:
        zero = True
        return 1
    elif biased_random == 1 and zero:
        zero = False
        return 0
    else:
        zero = True
        return 1

def unbiased_random(0,1):
    while True:
        x = biased_random()
        y = biased_random()
        if x == y:
            break
    return x
