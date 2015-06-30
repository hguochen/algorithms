class Node(object):
    """

    Node structure for binary search tree nodes.

    """
    def __init__(self, data=None, left=None, right=None):
        self.data = data
        self.left = left
        self.right = right


class BinarySearchTree(object):
    """

    Implementation of binary search tree with node structure.

    """
    def __init__(self, data=None):
        self.root = Node(data)
