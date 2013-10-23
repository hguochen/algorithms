##################################
###	Coin Change  #################
##################################

# Given coins of specific denominations, find the least amount of coins needed for a given amount

coins = [100, 50, 20, 10, 5, 1]
coin_number = [None] * len(coins)

while(1):
	amount = int(raw_input('Enter the amount for coin change: '))
	if amount <= 0:
		continue
	else:
		for index in range(len(coins)):
			coin_number[index] = int(amount / coins[index])
			print coin_number[index]
			amount -= coin_number[index] * coins[index]
	print coin_number