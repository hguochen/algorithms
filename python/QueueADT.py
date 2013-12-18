##################################
### Title: QueueADT       ########
### Author: GuoChen Hou   ########
##################################

# A sample implementation of queue ADT structure

class QueueADT:
	def __init__(self):
		self.queue = []
		self.front = 0
		self.back = 0

	def is_empty(self):
		return (self.front == self.back)

	def peek(self):
		"""Return the front of the queue"""
		if self.is_empty():
			return None
		else:
			return self.queue[self.front] 

	def poll(self):
		"""Remove and return the front of the queue"""
		if self.is_empty():
			obj = None
		else:
			obj = self.queue[self.front]
			self.queue.pop(self.front)
			self.front += 1
		return obj

	def offer(self, obj):
		"""Add item to the back of the queue"""
		if self.front == self.back:
			return False
		else:
			self.queue[back] = obj
			self.back += 1
			return True
