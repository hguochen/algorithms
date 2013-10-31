##################################
### Title: Tower of Hanoi ########
### Author: GuoChen Hou   ########
##################################

# This program is a recursive solution of the Tower of Hanoi problem
# For a recursive solution, the algorithm is as follows:
# if(n > 0)
# 	move n-1 disks from the source peg to the temp peg using the dest peg
# 	move disk n from the source peg to the dest peg
# 	move n-1 disks from the temp peg to the dest peg using the source peg

def solve_tower(source, temp, dest, number):
	if number > 0:
		solve_tower(source, dest, temp, number-1)
		print 'Move disk %d from peg %s to peg %s.' % (number, source, dest)
		solve_tower(temp, source, dest, number-1)

num = int(raw_input('Number of disks: '))

solve_tower('A', 'B', 'C', num)