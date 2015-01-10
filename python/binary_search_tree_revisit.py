from collections import deque

# Implementation of BinarySearchTree with node structure
#
# BinarySearchTree Operations
#
# Public operations:
# __init__(): Initializes the data members
# insert(data): Insert a new node with data into the tree
# delete(root, data): Removes a node with its data value 'data'
# find(root, data): Find a value in the tree, return none if value is not found
# size(root): Return the total number of nodes in the tree
# max_depth(root): Return the height of the tree
# min(root): Finds the minimum value in the tree
# max(root): Finds the maximum value in the tree
# has_value(root, data): Find the value 'data' in the tree. Return true if
#                       value is found false otherwise.
# print_tree_inorder(): Prints the tree path by in-order traversal
# print_tree_preorder(): Prints the tree path by preorder traversal
# print_tree_postorder(): Prints the tree path by postorder traversal


class Node(object):
    """
    Node data structure for a binary search tree.

    """
    def __init__(self, data=None, left=None, right=None, parent=None):
        """
        Initialize data members: data, left, right, parent.

        """
        self.data = data
        self.left = left
        self.right = right
        self.parent = parent


class BinarySearchTree(object):
    """
    A binary search tree that uses Node structure.

    """
    def __init__(self, data=None):
        """
        Initialize root node.

        """
        self.root = Node(data)

# PUBLIC METHODS

    def get_root(self):
        """
        Return a reference to root.

        """
        return self.root

    def insert(self, data):
        """
        Insert the value data into binary search tree.

        """
        if self.root.data is None:
            self.root.data = data
        else:
            # add a node with data into binary search tree
            new_node = Node(data)
            self._add_node(self.root, new_node)
        return self.root

    def delete(self, data):
        """
        Removes a node in tree with value 'data' and return the data.

        If data is not present, return None.
        """
        node = self.lookup(self.root, data)
        if node is None:
            return None
        else:
            # data value is found in tree
            if node.left is not None and node.right is not None:
                # case 1: node has 2 child nodes
                pass  # MISSING LOGIC HERE
            elif node.left is not None or node.right is not None:
                # case 2: node has 1 child node
                if node.left is not None:
                    # deleting node has a left child
                    if node.parent.left.data == data:
                        # deleting node is a left child of its parent
                        node.parent.left = node.left
                        node.left.parent = node.parent
                        node.left = None
                    else:
                        # deleting node is a right child of its parent
                        node.parent.left = node.right
                        node.right.parent = node.parent
                        node.right = None
                    node.parent = None
                else:
                    # deleting node has a right child
                    if node.parent.left.data == data:
                        # deleting node is a left child of its parent
                        node.parent.right = node.left
                        node.left.parent = node.parent
                        node.left = None
                    else:
                        # deleting node is a right child of its parent
                        node.parent.right = node.right
                        node.right.parent = node.parent
                        node.right = None
                    node.parent = None
            else:
                # case 3: node has 0 child node
                if node.parent.left.data == data:
                    # deleting node is a left child
                    node.parent.left = None
                    node.parent = None
                else:
                    # deleting node is a right child
                    node.parent.right = None
                    node.parent = None

    def lookup(self, root, data):
        """
        Find the value 'data' in the tree with root node. Return the data node
        reference if found, else return None

        """
        if root is None:
            return None
        else:
            if data == root.data:
                return root
            else:
                if data < root.data:
                    return self.lookup(root.left, data)
                else:
                    return self.lookup(root.right, data)

    def has_value(self, root, data):
        """
        Check if tree with root as 'root' has data and return True if value
        exists, otherwise return False.

        """
        if self.lookup(root, data) is None:
            return False
        return True

    def print_preorder(self, node):
        """
        Print the tree by pre order traversal method.

        """
        if node is None:
            return
        print node.data,
        self.print_preorder(node.left)
        self.print_preorder(node.right)
        return

    def print_inorder(self, node):
        """
        Print the tree by in order traversal method.

        """
        if node is None:
            return
        self.print_inorder(node.left)
        print node.data,
        self.print_inorder(node.right)
        return

    def print_postorder(self, node):
        """
        Print the tree by post order traversal method.

        """
        if node is None:
            return
        self.print_postorder(node.left)
        self.print_postorder(node.right)
        print node.data,
        return

    def print_levelorder(self, node):
        """
        Print the tree by level order traversal method.

        """
        if node is None:
            return
        queue = deque([node])
        while len(queue) > 0:
            trav = queue.popleft()
            print trav.data,
            if trav.left is not None:
                queue.append(trav.left)
            if trav.right is not None:
                queue.append(trav.right)
        return

# PRIVATE METHODS

    def _add_node(self, root, new_node):
        """
        Insert a new node into the binary search tree.

        """
        if new_node.data < root.data:
            if root.left is None:
                root.left = new_node
                new_node.parent = root
            else:
                self._add_node(root.left, new_node)
        else:
            if root.right is None:
                root.right = new_node
                new_node.parent = root
            else:
                self._add_node(root.right, new_node)
        return


if __name__ == "__main__":
    tree = BinarySearchTree(8)
    tree.insert(3)
    tree.insert(10)
    tree.insert(1)
    tree.insert(6)
    tree.insert(4)
    tree.insert(7)
    tree.insert(14)
    tree.insert(13)
    root = tree.get_root()
    tree.print_preorder(root)
    print "\n"
    tree.print_inorder(root)
    print "\n"
    tree.print_postorder(root)
    print "\n"
    tree.print_levelorder(root)
    tree.delete(10)
    print "\n"
    tree.print_preorder(root)
    print "\n"
    tree.print_preorder(root)