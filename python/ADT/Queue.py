##################################
### Title: Queue          ########
### Author: GuoChen Hou   ########
##################################

# Queue ADT: FIFO
# Operations:
# __init__(): initialize an empty queue
# empty(): Return true if queue is empty, false otherwise.
# enqueue(value): Add the item value to the end of the queue
# dequeue(): Remove the least recently added item from the queue
# front(): Return the item least recently added to the queue, but do not remove it.

# Array implementation of queue ADT structure
class Queue_Array:
	"""
	Implementing a queue ADT using a list data structure.
	List[0] is the front of the queue. List[-1] is the end of the queue.
	"""
	def __init__(self):
		"""
		Initialize a list when class instance is declared.
		"""
		self.queue = []
		
	def empty(self):
		"""
		Return true if queue is empty, else return false
		"""
		return len(self.queue) == 0

	def front(self):
		"""
		Return the item least recently added to the queue, but do not remove it.
		"""
		if self.is_empty():
			return None
		else:
			return self.queue[0]

	def dequeue(self):
		"""
		Remove and return the least recently added item from the queue.
		"""
		if self.is_empty():
			return None
		else:
			return self.queue.pop(0)		

	def enqueue(self, value):
		"""
		Add the item 'value' to the end of the queue and return the queue.
		"""
		self.queue.append(value)
		return self.queue

	def print_queue():
		"""
		Print the queue in order from front to back.
		"""
		print self.queue


# Doubly Linked list implementation of queue
class Node:
	"""
	Node structure for Queue_linkedlist class.
	"""
	def __init__(self, data=None):
		self.data = data
		self.left = None
		self.right = None

class Queue_linkedlist:
	"""
	Implementing a queue ADT using a doubly linked list data structure
	"""
	def __init__(self):

