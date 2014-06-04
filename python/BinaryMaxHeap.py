class BinaryMaxHeap:
	"""
	BinaryMaxHeap class implements binary maxheap data structure represented using an array.
	"""

	def __init__(self):
		self.heap = []

	def largest(self):
		"""
		Returns the largest value in the heap
		"""
		return self.heap[0]

	def insert(value):
		"""
		Insert the value into heap structure and return a list
		"""
		self.heap.append(value)
		if len(this.heap) == 1:
			return self.heap

		value_index = len(self.heap) - 1
		if value_index % 2 == 0: # value added as a right child
			parent_index = (value_index - 1) / 2
		else: # value added as a left child
			parent_index = value_index / 2

		while value_index > 0 and value > self.heap(parent_index): # value_index is not root AND value is bigger than its parent
			self.heap[value_index] = self.heap[parent_index]
			value_index = parent_index
		self.heap[value_index] = value
		return self.heap
		

