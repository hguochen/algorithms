##################################
###	Fibonacci Sequence ###########
##################################

# This program takes a number as the sequence number of fibonacci and returns the 
# fibonacci sequence up to that number sequence

def fibonacci_number(index):	
	if index <= 0:
		return 0
	elif index == 1:
		return 1
	else:
		return fibonacci_number(index-1) + fibonacci_number(index-2)

def sequence(index):
	fib_sequence = [None] * (index+1)
	for i in range(index+1):
		fib_sequence[i] = fibonacci_number(i)

	return fib_sequence

while True:
	try:
		index = int(raw_input('Enter the index for Fibonacci sequence or "quit" to quit: '))
	except ValueError:
		print 'Bye'
		break
	print sequence(index)