##################################
### Title: Binary Tree    ########
### Author: GuoChen Hou   ########
##################################

# Implementation of a basic binary tree with Node structure


class Node(object):
    """
    Node data structure for a binary tree.
    """

    def __init__(self, data=None):
        """
        Initialize the node with data members: data, left child and right
        child.
        """

        self.data = data
        self.left = None
        self.right = None


class BinaryTree(object):
    """
    A binary tree with its nodes having Node class structure.
    """

    def __init__(self, root=None):
        """
        Initialize the root member.
        """

        self.root = root

    def get_root(self):
        """
        Return the root of the tree.
        """
        return self.root

    def add_node(self, data):
        """
        Create a new node and return it.
        """

        return Node(data)

    def insert(self, root, data):
        """
        Insert a new data into the binary tree.
        """

        # tree is empty
        if root is None:
            root.add_node(data)
        else:  # tree is not empty
            new_node = self.add_node(data)
            if new_node.data <= root.data:
                # process left sub-tree
                root.left = self.insert(root, data)
            else:
                # process right sub-tree
                root.right = self.insert(root, data)
        return root

    def delete(self, data):
        """
        Delete the node with data in the binary tree.
        """
        pass

    def lookup(self, root, target):
        """
        Looks for a value into the tree.
        """
        pass

    def min(self):
        """
        Looks for the minimum value in the tree.
        """
        pass

    def max(self):
        """
        Look for the maximum value in the tree.
        """
        pass

    def max_depth(self):
        """
        Return the maximum depth of the tree.
        """
        pass

    def size(self, root):
        """
        Return the size of the tree.
        """
        pass

    def print_tree(self):
        """
        Print the tree path.
        """
        pass

    def print_rev_tree(self):
        """
        Print the tree path in reverse order.
        """
        pass


if __name__ == "__main__":
    pass
