import copy 

class Node:
	"""
	Node class defines the basic structure of a node.
	"""
	def __init__(self, vertex=None, weight=None, next=None):
		self.vertex = vertex
		self.weight = weight
		self.next = next

class LinkedList:
	"""
	LinkedList of nodes representing the vertices adjacent to vertex i. Each node has members ver, the vertex adjacent to i; weight, representing the weight of edge (i, ver); 
	and next, a reference to the next node in the linked list or null, for the last node in the linked list.
	"""
	def __init__(self):
		self.head = Node()

	def get_head(self):
		"""
		Returns a reference to the head node
		"""
		return self.head

	def add(self, vertex, weight):
		"""
		Append a new node with node.vertex as vertex to the last element in the linked list
		"""
		new_node = Node(vertex, weight)
		trav = self.head
		while(trav.next != None):
			trav = trav.next
		trav.next = new_node

	def print_list(self):
		trav = self.head.next
		while trav != None:
			print "(%d, %d)" % (trav.vertex, trav.weight),
			trav = trav.next


def dijkstra():
	# Implement dijsktra algo using binary minheap abstract data structure
	pass

if __name__ == "__main__":
	adj_list = [0] * 6 # an array of adjacency list instances
	adj = copy.deepcopy(adj_list) # references to head node

	for i in range(len(adj_list)):
		adj_list[i] = LinkedList() # declare linked list instance
		adj[i] = adj_list[i].get_head() # reference adj[i] to head node

	# Setup the adjacency list
	adj_list[0].add(1, 80)
	adj_list[0].add(2, 40)
	adj_list[0].add(4, 60)

	adj_list[1].add(0, 80)
	adj_list[1].add(3, 100)

	adj_list[2].add(0, 40)
	adj_list[2].add(3, 20)
	adj_list[2].add(5, 60)
	adj_list[2].add(4, 120)

	adj_list[3].add(1, 100)
	adj_list[3].add(2, 20)
	adj_list[3].add(5, 120)

	adj_list[4].add(0, 60)
	adj_list[4].add(2, 120)
	adj_list[4].add(5, 40)

	adj_list[5].add(4, 40)
	adj_list[5].add(2, 60)
	adj_list[5].add(3, 120)

	print adj_list[0].print_list()
	print adj_list[1].print_list()
	print adj_list[2].print_list()
	print adj_list[3].print_list()
	print adj_list[4].print_list()
	print adj_list[5].print_list()