##################################
### Title: Tree           ########
### Author: GuoChen Hou   ########
##################################

# Operations:
# __init__(): Initializes the data members
# add_node(): 
# insert(root, data): Inserts a new node with data with root as its parent
# lookup(target): Looks for a value in the tree
# min(): Returns the min data value in the tree
# max_depth(): Return the height of the tree
# size(): Return the total number of nodes in the tree
# print_tree(): Prints the tree path by in-order traversal

# Implementation of basic Binary Tree with list data structure
class Binary_tree:
	"""
	Implementing a binary tree using a list data structure
	"""
	def __init__(self, tree_height, root_value):
		"""
		Upon class instance declaration, the maximum height of the tree must be defined.
		Tree root has value 'root_value', with left and right child initialized to 1 & 2 respectively.
		"""
		self.tree = [None] * (2**tree_height - 1)		
		self.tree[0] = [root_value, 1, 2]
		self.height = tree_height
		print self.tree

	def __str__(self):
		return "Binary_tree"

	def add_node(self, data, pos):
		"""
		Add a node with 'data' value to position 'pos'
		"""	
		try:
			if pos % 2 == 0: # right child
				parent = (pos-1) // 2
			else:
				parent = pos // 2
			if self.tree[parent] == None:
				return "Parent not found."
			# determine child index
			left_child = pos * 2 + 1
			right_child = pos * 2 + 2
			if left_child >= 2**self.height - 1:
				left_child = None
				right_child = None
			
			# append new node into tree
			self.tree[pos] = [data, left_child, right_child]
		except IndexError:
			print "Maximum height reached."
		return self.tree

	def del_node(self, pos):
		"""
		"""
		if self.tree[pos][1] == None and self.tree[pos][2] == None:
			self.tree[pos] = None
		else:
			if self.tree[pos][1] != None:
				self.tree[pos] = self.tree[self.tree[pos][1]]
				self.tree[self.tree[pos][1]] = None
			elif self.tree[pos][2] != None:
				self.tree[pos] = self.tree[self.tree[pos][2]]
				self.tree[self.tree[pos][2]] = None
		return self.tree
		

# Implementation of ordered Binary Tree with node structure
class Node:
	"""
	Node structure for binary ordered tree.
	"""
	def __init__(self, data=None, left=None, right=None):
		"""
		Initialize data members
		"""
		self.data = data
		self.left = left
		self.right = right

class Binary_ordered_tree:
	"""
	A binary ordered tree class that uses Node class structure.
	"""
	def __init__(self):
		"""
		Initializes the root member
		"""
		self.root = None

	def add_node(self, data):
		"""
		Creates a new node and returns the node reference
		"""
		return Node(data)

	def insert(self, root, data):
		"""
		Insert a new node with value 'data' and root as its parent
		"""
		if root == None:
			root = self.add_node(data)
			return root
		else:
			# enter the tree
			if data <= root.data:
				root.left = self.insert(root.left, data)
			else:
				root.right = self.insert(root.right, data)
			return root

	def lookup(self, root, target):
		"""
		Looks for a value in the tree and return True if found, else return false
		"""
		if root == None:
			return False
		else:
			if target == root.data:
				return True
			else:
				if target < root.data:
					return self.lookup(root.left, target)
				else:
					return self.lookup(root.right, target)

	def min(self, root):
		"""
		Returns the minimum value in the tree
		"""
		while root.left != None:
			root = root.left
		return root.data

	def max(self, root):
		"""
		Returns the maximum value in the tree
		"""
		while root.right != None:
			root = root.right
		return root.data

	def max_depth(self, root):
		"""
		Returns the height of the tree.
		"""
		if root == None:
			return 0
		else:
			left_depth = self.max_depth(root.left)
			right_depth = self.max_depth(root. right)
			return max(left_depth, right_depth) + 1

	def size(self, root):
		"""
		Return the total number of nodes in the tree.
		"""
		if root == None:
			return 0
		else:
			return self.size(root.left) + 1 + self.size(root.right)

	def print_tree(self, root):
		"""
		Print the tree by in-order traversal method.
		"""
		if root == None:
			pass
		else:
			self.print_tree(root.left)
			print root.data
			self.print_tree(root.right)


if __name__ == "__main__":
	tree = Binary_ordered_tree()
	root = tree.add_node(0)

	for i in range(0,5):
		data = int(raw_input("Insert the node value at number %d: " % i))
		tree.insert(root, data)
	tree.print_tree(root)

	data = int(raw_input("Insert a value to find: "))
	if tree.lookup(root, data):
		print "Found"
	else:
		print "Not Found"

	print tree.min(root)
	print tree.max_depth(root)
	print tree.size(root)