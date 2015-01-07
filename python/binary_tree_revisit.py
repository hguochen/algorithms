# This is a revisit of binary tree algorithm

# Implement a binary tree with node structure


class Node(object):
    """
    Data structure for a node in a binary tree.

    """

    def __init__(self, data=None):
        """
        Initialize data memberes.

        """
        self.data = data
        self.left = None
        self.right = None


class BinaryTree(object):
    """
    A binary tree with its nodes having Node structure.

    """

    def __init__(self, root_data=None):
        """
        Initialize the root member.

        """
        self.root = Node(root_data)

    def get_root(self):
        """
        Return the root of the tree.

        """
        return self.root

    def get_left_child(self, parent_node=None):
        """
        Return the left child of the parent_node. If parent_node is null,
        return the left child of root node.

        """
        if parent_node is not None:
            return parent_node.left
        else:
            return self.root.left

    def get_right_child(self, parent_node=None):
        """
        Return the right child of the parent_node. If parent_node is null,
        return the right child of root node.

        """
        if parent_node is not None:
            return parent_node.right
        else:
            return self.root.right

    def add_node(self, data=None):
        """
        Create a new node and return it.

        """
        return Node(data)

    def insert(self, new_node, direction):
        """
        Insert a new node in the direction of binary tree.

        """
        if direction == 'left':
            traverse = self.root
            while traverse.left is not None:
                traverse = traverse.left
            traverse.left = new_node
        elif direction == 'right':
            traverse = self.root
            while traverse.right is not None:
                traverse = traverse.right
            traverse.right = new_node

    def lookup(self, data):
        """
        Looks for a value into the tree and return True if value exists,
        False otherwise.

        """
        if self.root is None:
            return False
        else:
            if self.root.data is data:
                return True
            else:
                # this is not a binary tree. so lookup so search for all possible nodes.
                # # we can use traversal methods to do this.
                # revise tree traversal methods
                pass

if __name__ == "__main__":
    tree = BinaryTree(0)
    node1 = Node(1)
    node2 = Node(2)
    tree.insert(node1, 'left')
    tree.insert(node2, 'right')
