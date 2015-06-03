class Node(object):
    """

    Node structure for a red black tree.

    """
    def __init__(self, data=None, black=True, left=None, right=None):
        self.data = data
        self.black = black
        self.left = left
        self.right = right
        self.parent = None


class RBTree(object):
    """

    A balanced tree implemented with a red black tree.

    """
    def __init__(self, data=None):
        """

        Initialize root node to be black.

        """
        self.root = Node(data)
