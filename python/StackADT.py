##################################
### Title: StackADT       ########
### Author: GuoChen Hou   ########
##################################

# A sample implementation of stack ADT structure
# Stack ADT: LIFO
# __init__: initialize a new empty stack
# push: add a new item to the stack
# pop: remove and return an item from the stack. The item that is returned is always the last one that was added
# isEmpty: check whether the stack is empty 
# Implementing stacks with python lists

class Stack:
	def __init__(self):
		self.items = []

	def peek(self):
		"""Return the topmost item from the stack"""
		if self.is_empty():
			return None
		else:
			return self.items[len(self.items)-1]

	def push(self, item):
		self.items.append(item)
		return None

	def pop(self):
		return self.items.pop()

	def is_empty(self):
		return (self.items == [])

	def size(self):
		return len(self.items)