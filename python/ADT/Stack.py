##################################
### Title: Stack Implementations #
### Author: GuoChen Hou   ########
##################################

# A sample implementation of stack ADT structure
# Stack ADT: LIFO
# Operations:
# __init__(): initialize a new empty stack
# push(value): add a new item to the stack
# pop(): remove and return an item from the stack. The item that is returned is always the last one that was added
# top(): return the item most recently added to the stack, but do not remove it.
# is_empty(): check whether the stack is empty 

class Stack_array:
	"""
	Implementing a stack ADT using a list data structure.

	List[0] is at the bottom of the stack. List[len(list)-1] is at the top of the stack.
	"""

	def __init__(self):
		"""
		Initialize a list when class instance is declared. 
		"""
		self.stack = []

	def empty(self):
		"""
		Return true if the stack is empty, else return false.
		"""
		return self.stack == []

	def push(self, value):
		"""
		Add the item 'value' to the stack and return a reference to the stack.
		"""
		self.stack.append(value)
		return self.stack

	def pop(self):
		"""
		Remove the item most recently added to the stack and return the removed value.
		"""
		return self.stack.pop()

	def top(self):
		"""
		Return the item at the top of the stack but do not remove it.
		"""
		if self.empty():
			return None
		return self.stack[len(self.stack)-1]

	def size(self):
		"""
		Return the size of the stack.
		"""
		return len(self.stack)

class Stack_linkedlist:
	"""
	Implementing a stack ADT using a list data structure.
	"""