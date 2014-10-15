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
            return self.add_node(data)
        else:  # tree is not empty
            new_node = self.add_node(data)
            if new_node.data <= root.data:
                # process left sub-tree
                root.left = self.insert(root.left, data)
            else:
                # process right sub-tree
                root.right = self.insert(root.right, data)
        return root

    def delete(self, data):
        """
        Delete the node with data in the binary tree.
        """
        pass

    def lookup(self, root, data):
        """
        Looks for a value into the tree and return True if value exists,
        false otherwise.
        """

        if root is None:
            return False
        else:
            if root.data is data:
                return True
            else:
                if data <= root.data:
                    return self.lookup(root.left, data)
                else:
                    return self.lookup(root.right, data)

    def min(self, root):
        """
        Looks for the minimum value in the tree.
        """

        while root.left is not None:
            root = root.left
        return root.data

    def max(self, root):
        """
        Look for the maximum value in the tree.
        """

        while root.right is not None:
            root = root.right
        return root.data

    def max_depth(self, root):
        """
        Return the maximum depth of the tree.
        """

        if root is None:
            return 0
        else:
            left_depth = self.max_depth(root.left)
            right_depth = self.max_depth(root.right)
            return max(left_depth, right_depth) + 1

    def size(self, root):
        """
        Return the size of the tree.
        """

        if root is None:
            return 0
        else:
            return self.size(root.left) + 1 + self.size(root.right)

    def print_tree(self, root):
        """
        Print the tree path.
        """

        if root is None:
            return
        else:
            self.print_tree(root.left)
            print root.data,
            self.print_tree(root.right)

    def print_rev_tree(self, root):
        """
        Print the tree path in reverse order.
        """

        if root is None:
            return
        else:
            self.print_rev_tree(root.right)
            print root.data,
            self.print_rev_tree(root.left)


if __name__ == "__main__":
    test_tree = BinaryTree()
    root = test_tree.add_node(0)
    for i in range(1, 5):
        test_tree.insert(root, i)
    test_tree.print_tree(root)
    print "\n"
    test_tree.print_rev_tree(root)

    if test_tree.lookup(root, 2):
        print "Value found."
    else:
        print "Value NOT found."
    print test_tree.min(root)
    print test_tree.max_depth(root)
    print test_tree.size(root)
