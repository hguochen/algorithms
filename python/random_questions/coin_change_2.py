def change(number, coins_available, coins_so_far):
    if sum(coins_so_far) == number:
        yield coins_so_far
    elif sum(coins_so_far) > number:
        pass
    elif coins_available == []:
        pass
    else:
        for c in change(number, coins_available[:], coins_so_far +
                        [coins_available[0]]):
            yield c
        for c in change(number, coins_available[1:], coins_so_far):
            yield c


def change_2(number, coins_available):
    result = []
    for coin in coins_available[::-1]:
        while number > 0:
            multiple = number / coin
            if multiple > 0:
                for i in xrange(multiple):
                    result.append(coin)
                number %= coin
            else:
                break

    return result

if __name__ == "__main__":
    num = 15
    coins = [1, 5, 10, 25]
    solutions = [s for s in change(num, coins, [])]
    for s in solutions:
        print s

    print 'optimal solution', min(solutions, key=len)
    print change_2(num, coins)
