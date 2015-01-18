########################################
### Title: Adjacency list ##############
### Author: GuoChen Hou   ##############
########################################

# An undirected and weighted graph implemented using adjacency list


class Vertex(object):
    """
    A weighted graph's vertices.

    """
    def __init__(self, key):
        self.key = key
        self.connected_to = {}

    def add_neighbour(self, neighbour, weight=0):
        self.connected_to[neighbour] = weight

    def __str__(self):
        return str(self.key) + ' conntected to: ' + \
            str([v.key for v in self.connected_to])

    def get_connections(self):
        return self.connected_to.keys()

    def get_key(self):
        return self.key

    def get_weight(self, neighbour):
        return self.connected_to[neighbour]


class Graph(object):
    """
    Graph representation using adjacency list.

    """
    def __init__(self):
        self.vert_list = {}
        self.vertex_count = 0

    def add_vertex(self, key):
        self.vertex_count += 1
        new_vertex = Vertex(key)
        self.vert_list[key] = new_vertex
        return new_vertex

    def get_vertex(self, neighbour):
        if neighbour in self.vert_list:
            return self.vert_list[neighbour]
        else:
            return None

    def __contains__(self, neighbour):
        return neighbour in self.vert_list

    def add_edge(self, vertex1, vertex2, cost=0):
        if vertex1 not in self.vert_list:
            self.add_vertex(vertex1)
        if vertex2 not in self.vert_list:
            self.add_vertex(vertex2)
        self.vert_list[vertex1].add_neighbour(self.vert_list[vertex2], cost)

    def get_vertices(self):
        return self.vert_list.keys()

    def __iter__(self):
        return iter(self.vert_list.values())


if __name__ == "__main__":
    graph = Graph()
    for i in range(6):
        graph.add_vertex(i)
    print graph.vert_list

    graph.add_edge(1, 2)
    graph.add_edge(1, 5)
    graph.add_edge(2, 1)
    graph.add_edge(2, 5)
    graph.add_edge(2, 3)
    graph.add_edge(2, 4)
    graph.add_edge(3, 2)
    graph.add_edge(3, 4)
    graph.add_edge(4, 2)
    graph.add_edge(4, 3)
    graph.add_edge(4, 5)
    graph.add_edge(5, 1)
    graph.add_edge(5, 2)
    graph.add_edge(5, 4)
    for vertex in graph:
        for connected_vertices in vertex.get_connections():
            print "[%s, %s]" % (vertex.get_key(), connected_vertices.get_key())
