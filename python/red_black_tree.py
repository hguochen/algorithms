#!/usr/bin/python
# -*- coding: utf-8 -*-

##################################
### Title: Red black tree ########
### Author: GuoChen Hou   ########
##################################

# Implementation of a red black tree with node data structure
#
# Public operations:
# __init__(): Initializes the data members
# insert(): Insert a new node with data into the tree
# delete(data): Removes a node with its data value 'data'
# find(): Find a value in the tree, return none if value is not found
# size(): Return the total number of nodes in the tree
# max_depth(): Return the height of the tree
# print_tree(): Prints the tree path by in-order traversal
#
# Private operations:
# ...


class Node:
    """
    Node data structure for a red black tree.
    """

    def __init__(self, data=None, left=None, right=None, parent=None):
        """
        Initialize data members: data, left, right.
        """

        self.data = data
        self.left = left
        self.right = right
        self.parent = parent


class RedBlackTree:
    """
    A red-black binary balanced tree that uses Node structure.
    """

    def __init__(self):
        """
        Initialize the root member
        """

        self.root = None

# PUBLIC METHODS

    def insert(self, data):
        """
        Inserts the value data into a binary tree with root 'root'.

        If tree is empty, root is None. Returns the root of the tree containing
        the new node.
        """

        # setup new node
        new_node = Node(data)

        if self.root is None:
            self.root = new_node
        else:
            self._insert(self.root, new_node)
        return self.root

    def delete(self, root, data):
        """
        Removes a node in tree with value 'data' and returns the data.

        If data is not present, return None.
        """

        if not self.has_value(root, data):
            return None
        else:  # data value is found in tree
            
            node = self.find(root, data)
            # case 1: node has 2 child nodes
            if node.left is not None and node.right is not None:                
                return self._remove(root, node)
            # case 2: node has 0 or 1 child node
            else:
                return self._replace(root, node)

    def find(self, root, data):
        """
        Find the value 'data' in the tree. Return the data node reference if found, else return None
        """

        if root is None:
            return None
        else:
            if data is root.data:
                return root
            else:
                if data < root.data:
                    return self.find(root.left, data)
                else:
                    return self.find(root.right, data)

    def has_value(self, root, data):
        """
        Find the value 'data' in the tree. Return true if value is found, false otherwise.
        """

        if self.find(root, data):
            return True
        return False

    def min(self, root):
        """
        Returns the minimum value in the tree
        """

        while root.left is not None:
            root = root.left
        return root.data

    def max(self, root):
        """
        Returns the maximum value in the tree.
        """

        while root.right is not None:
            root = root.right
        return root.data

    def size(self, root):
        """
        Return the total number of nodes in the tree.
        """

        if root is None:
            return 0
        else:
            return self.size(root.left) + 1 + self.size(root.right)

    def max_depth(self, root):
        """
        Returns the height of the tree.
        """

        if root is None:
            return 0
        else:
            left_depth = self.max_depth(root.left)
            right_depth = self.max_depth(root.right)
            return max(left_depth, right_depth) + 1

    def print_tree_preorder(self, root):
        """
        Prints the data of the tree with root 'root' by preorder traversal.
        """

        if root is not None:
            print root.data,
            self.print_tree_preorder(root.left)
            self.print_tree_preorder(root.right)

    def print_tree_inorder(self, root):
        """
        Prints the data of the tree with root 'root' by inorder traversal.
        """

        if root is not None:
            self.print_tree_inorder(root.left)
            print root.data,
            self.print_tree_inorder(root.right)

    def print_tree_postorder(self, root):
        """
        Prints the data of the tree with root 'root' by postorder traversal.
        """

        if root is not None:
            self.print_tree_postorder(root.left)
            self.print_tree_postorder(root.right)
            print root.data,

# PRIVATE METHODS

    def _min_node(self, node):
        """
        Return the node with minimum value in the tree.
        """

        while node.left is not None:
            node = node.left
        return node

    def _max_node(self, node):
        """
        Return the node with minimum value in the tree.
        """

        while node.right is not None:
            node = node.right
        return node

    def _insert(self, root, node):
        """
        Recursively add the node into tree with root 'root'.
        """

        if node.data < root.data:
            if root.left is None:
                root.left = node
                node.parent = root
            else:
                self._insert(root.left, node)
        else:
            if root.right is None:
                root.right = node
                node.parent = root
            else:
                self._insert(root.right, node)

    def _replace(self, root, node):
        """
        Replaces the node referenced by node with its child from a tree with 
        root 'root'. The node referenced by 'node' has 0 or 1 child.
        Returns the root of the tree that results from deleting the node.
        """

        # Set child to ref's child, or null if no child.
        if node.left is None:
            child = node.right
        else:
            child = node.left

        # if root node is to be deleted, set its child as the new root
        if node is root:
            if child is not None:
                child.parent = None                
                return child

        # if node has a parent and a child, set child's parent as its grandparent and vice versa
        if node.parent.left is node:  # node is a left child
            node.parent.left = child
        else:
            node.parent.right = child
        if child is not None:
            child.parent = node.parent
        return root
        
    def _remove(self, root, node):
        """
        Removes the node referenced by node with its smaller data value child 
        from a tree with root 'root'. The node referenced by 'node' has 2 child.
        Returns the root of the tree tat results from deleting the node.
        """

        # find successor node in the right tree of node containing a minimum data
        successor = self._min_node(node)
        while successor.left is not None:
            successor = successor.left

        # 'move' successor data to node, thus achieving deletion of node
        node.data = successor.data

        # successor has 0 or 1 child, remove with _replace method
        return self._replace(root, successor)

if __name__ == "__main__":
    test = RedBlackTree()
    test.insert(8)
    test.insert(3)
    test.insert(10)
    test.insert(1)
    test.insert(6)
    test.insert(4)
    test.insert(7)
    test.insert(14)
    test.insert(13)
    test.print_tree_inorder(test.root)
    print "--"
    test.print_tree_preorder(test.root)
    print "--"
    test.print_tree_postorder(test.root)
    print "--"
    test.delete(test.root, 3)
    print "--"
    test.print_tree_inorder(test.root)
    print test.size(test.root)
    print test.max_depth(test.root)
