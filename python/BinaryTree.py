##################################
### Title: BinaryTree     ########
### Author: GuoChen Hou   ########
##################################

# Implementing a binary tree 

class Node:
	"""
	Basic node structure for a binary search tree
	"""
	def __init__(self, data):
		self.data = data
		self.left = None
		self.right = None

class BinaryTree:
	"""
	Binary search tree implementation
	"""

	def __init__(self, data):
		self.root = Node(data)

	def get_root(self):
		return self.root

	def add(self, data, node):
		"""
		Insert a new node at the position determined by its data
		"""
		if data < node.data: # left child
			if node.left != None:
				self.add(data, node.left)
			else:
				new_node = Node(data)
				node.left = new_node
				print "Node %d has been added as a left child of %d." % (data, node.data)
		else: # right child
			if node.right != None:
				self.add(data, node.right)
			else:
				new_node = Node(data)
				node.right = new_node
				print "Node %d has been added as a right child of %d." % (data, node.data)

if __name__ == "__main__":
	tree = BinaryTree(5)
	tree.add(3, tree.get_root())
	tree.add(7, tree.get_root())
	tree.add(2, tree.get_root())
	tree.add(8, tree.get_root())