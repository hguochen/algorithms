# Given a directed graph, design an algorithm to find out whether there is a
# route between two nodes.

# How to design a directed graph?
# Easier with adjacency matrix
# Harder to determine with adjacency list.


class Graph(object):
    """

    Adjacency matrix implementation of graph.

    """
    def __init__(self, n_vertices):
        self.graph = [[0 for _ in xrange(n_vertices)] for _ in xrange(n_vertices)]

    def print_graph(self):
        for i in self.graph:
            print i
        return

    def has_route(self, vertice1, vertice2):
        """

        Given a directed graph, Return True if node1 and node2 are connected.

        """
        return True if self.graph[vertice1][vertice2] == 1 else False

if __name__ == "__main__":
    graph = Graph(5)
    graph.print_graph()
    print graph.has_route(1, 2)
