import copy
from collections import deque

class Node:
	"""
	Node class defines the basic structure of a node.
	"""
	def __init__(self, vertex=None, next=None):
		self.vertex = vertex
		self.next = next

class LinkedList:
	"""
	LinkedList class defines a linked list of nodes in which node.next reference the next node in the list
	"""

	def __init__(self):
		self.head = Node()

	def get_head(self):
		"""
		Returns a reference to the head node
		"""
		return self.head

	def add(self, vertex):
		"""
		Append a new node with node.vertex as vertex to the last element in the linked list
		"""
		new_node = Node(vertex)
		trav = self.head
		while(trav.next != None):
			trav = trav.next
		trav.next = new_node

def breadth_first_search(adj, start_index):
	"""
	This function executes a breadth-first search beginning at vertex start_index in a graph with vertices 1, ... ,n and outputs the 
	vertices in the order in which they are visited.
	
	The graph is represented using adjacency lists; adj[i] is a reference to the first node in a linked list of nodes representing the
	vertices adjacent to vertex i. Each node has members ver, the vertex adjacent to i, and next, a reference to the next node in the linked list or
	null, for the last node in the linked list.

	To track visited vertices, the algorithm uses an array visit; visit[i] is set to true if vertex i has been visited or to false if vertex i
	has not been visited.

	The algorithm uses an initially empty queue to store pending curent vertices.
	"""
	current_queue = deque()
	visit = [False] * len(adj) # initialize visit array to false
	visit[start_index] = True
	print start_index
	current_queue.append(start_index) # current_queue is initially empty queue

	while len(current_queue) != 0:
		current = current_queue.popleft()
		trav = adj[current].next
		while trav != None:
			ver = trav.vertex			
			if not visit[ver]:
				visit[ver] = True
				print ver
				current_queue.append(ver)
			trav = trav.next

def shortest_paths(adj, start_index):
	current_queue = deque()
	length = [None] * len(adj)
	length[start_index] = 0
	current_queue.append(start_index) # current_queue is initially empty queue

	while len(current_queue) != 0:
		current = current_queue.popleft()
		trav = adj[current].next
		while trav != None:
			ver = trav.vertex
			if length[ver] == None:
				length[ver] = 1 + length[current]
				current_queue.append(ver)
			trav = trav.next
	return length


if __name__ == "__main__":
	size = int(raw_input("Enter the number of vertex: "))
	adj_list = [0] * size # an array of adjacency list instances
	adj = copy.deepcopy(adj_list) # references to head node

	for i in range(len(adj_list)):
		adj_list[i] = LinkedList() # declare linked list instance		
		adj[i] = adj_list[i].get_head() # reference adj[i] to head node

	# Setup the adjacency list
	adj_list[0].add(1)
	adj_list[0].add(2)
	
	adj_list[1].add(0)
	adj_list[1].add(3)

	adj_list[2] = copy.deepcopy(adj_list[1])

	adj_list[3].add(1)
	adj_list[3].add(2)
	adj_list[3].add(4)

	adj_list[4].add(3)

	breadth_first_search(adj, 0)
	print shortest_paths(adj, 0)