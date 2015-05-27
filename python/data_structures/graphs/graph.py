# Adjacency matrix structure
# PRO
# - faster test if an edge is in graph
# - less memory in big graphs
# - faster edge insertion/deletion
#
# Con
# - uses O(n*n) memory
# - slow to iterate over all edges
#
# ADjacency list structure
# PRO
# - faster to find degree of vertex
# - less memory on small graphs
# - faster graph traversal
# - better for most graph problems
# - use memory in proportion to number of edges


# Implementation of graph using adjacency list structure.


class Edge(object):
    """

    Node structure for graph edges.

    """
    def __init__(self, info=None, weight=None):
        self.info = info
        self.weight = weight
        self.next = None

    def get_info(self):
        return self.info

    def set_info(self, info):
        self.info = info
        return


class Graph(object):
    """

    Adjacency list graph.

    """
    def __init__(self, n_vertices, n_edges, info=None, weight=None,
                 degree=None, directed=False):
        self.edges = []
        self.degree = []  # number of entries for each vertex
        self.n_vertices = n_vertices
        self.n_edges = n_edges
        self.directed = directed  # True if graph is directed
        for i in range(n_vertices):
            self.edges.append(Edge())
            self.degree.append(0)

    def insert_edge(self, vertice, dest):
        """

        Add an edge to *vertice*.

        """
        vertice -= 1  # 0 indexing
        if self.edges[vertice].get_info() is None:
            self.edges[vertice].set_info(dest)
            self.degree[vertice] += 1
            return
        curr = self.edges[vertice]
        while curr.next is not None:
            curr = curr.next
        curr.next = Edge(info=dest)
        self.degree[vertice] += 1
        return

    def print_graph(self):
        for edges in self.edges:
            while edges is not None:
                print edges.get_info(),
                edges = edges.next
            print ""
        print "Degree of each vertex: %s" % self.degree
        return

    def breadth_first_search(self, start):
        start -= 1  # 0 indexing
        # initialize a bool list for vertices
        visited = [False for _ in range(self.n_vertices)]
        # initialize queue
        queue = []
        visited[start] = True
        print start+1,
        curr = self.edges[start]
        # add edges for start node to queue
        while curr is not None:
            queue.append(curr)
            curr = curr.next

        while len(queue) > 0:
            node = queue.pop(0)
            trav = node
            while trav is not None:
                if visited[trav.get_info()-1] is False:
                    visited[trav.get_info()-1] = True
                    print trav.get_info(),
                    curr = self.edges[trav.get_info()-1]
                    while curr is not None:
                        queue.append(curr)
                        curr = curr.next
                trav = trav.next
        return


def init_graph():
    """

    Initialize a graph.

    """
    with open('data_structures/graphs/graph2.txt') as f:
        n_vertices, n_edges = map(int, f.readline().split())
        graph = Graph(n_vertices, n_edges)
        print n_vertices, n_edges
        for line in f:
            edge = map(int, line.split())
            graph.insert_edge(edge[0], edge[1])
        graph.print_graph()
        return graph
if __name__ == "__main__":
    graph = init_graph()
    graph.breadth_first_search(1)
