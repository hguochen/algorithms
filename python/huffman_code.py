class Node:
	"""
	Node structure for huffman nodes.
	"""
	
	def __init__(self, character=None, freq=None):
		self.character = character
		self.freq = freq
		self.left = None
		self.right = None

class HuffmanTree:
	"""
	Binary Tree structure for huffman nodes.
	"""

	def __init__(self, character=None, freq=None):
		self.root = Node()
		self.ref = self.root # references the root node
		self.queue = [] # temporary storage for stray nodes

	def insert(self, node_ref):
		"""
		Insert a new node into existing huffman tree.
		If node_ref.left.freq == root.freq, node_ref.left = root.freq. Set ref point to node_ref.
		elif node_ref.right.freq == root.freq, node_ref.right = root.freq. Set ref point to node_ref.
		else add node_ref to queue
		"""

	def construct_tree(self):
		"""
		Add all stray nodes in queue into tree and return ref to the root node
		"""
		while len(self.queue) > 0:
			for node_ref in self.queue:
				while self.ref != null