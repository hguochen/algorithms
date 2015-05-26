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


# ADD METHOD TO INSERT GRAPH


def init_graph():
    """

    Initialize a graph.

    """
    with open('data_structures/graphs/graph1.txt') as f:
        n_vertices, n_edges = map(int, f.readline().split())
        print n_vertices, n_edges
        for line in f:
            edge = map(int, line.split())
            print edge  # add edge
    graph = Graph(n_vertices, n_edges)

    #  insert edges
    for i in range(n_edges):
        pass

if __name__ == "__main__":
    init_graph()
