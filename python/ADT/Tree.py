#!/usr/bin/python
# -*- coding: utf-8 -*-

##################################
### Title: Tree           ########
### Author: GuoChen Hou   ########
##################################

# Operations:
# __init__(): Initializes the data members
# add_node(): Create a new node and return the node reference
# insert(root, data): Inserts a new node with data with root as its parent
# lookup(target): Looks for a value in the tree
# min(): Returns the min data value in the tree
# max_depth(): Return the height of the tree
# size(): Return the total number of nodes in the tree
# print_tree(): Prints the tree path by in-order traversal

# Implementation of basic Binary Tree with list data structure


class Binary_tree:

    """
    Implementing a binary tree using a list data structure
    """

    def __init__(self, tree_height, root_value):
        """
        Upon class instance declaration, the maximum height of the tree must be defined.
        Tree root has value 'root_value', with left and right child initialized to 1 & 2 respectively.
        """

        self.tree = [None] * (2 ** tree_height - 1)
        self.tree[0] = [root_value, 1, 2]
        self.height = tree_height
        print self.tree

    def __str__(self):
        return 'Binary_tree'

    def add_node(self, data, pos):
        """
        Add a node with 'data' value to position 'pos'
        """

        try:
            if pos % 2 == 0:  # right child
                parent = (pos - 1) // 2
            else:
                parent = pos // 2
            if self.tree[parent] == None:
                return 'Parent not found.'

            # determine child index

            left_child = pos * 2 + 1
            right_child = pos * 2 + 2
            if left_child >= 2 ** self.height - 1:
                left_child = None
                right_child = None

            # append new node into tree

            self.tree[pos] = [data, left_child, right_child]
        except IndexError:
            print 'Maximum height reached.'
        return self.tree

    def del_node(self, pos):
        """
        """

        if self.tree[pos][1] == None and self.tree[pos][2] == None:
            self.tree[pos] = None
        else:
            if self.tree[pos][1] != None:
                self.tree[pos] = self.tree[self.tree[pos][1]]
                self.tree[self.tree[pos][1]] = None
            elif self.tree[pos][2] != None:
                self.tree[pos] = self.tree[self.tree[pos][2]]
                self.tree[self.tree[pos][2]] = None
        return self.tree


# Implementation of ordered Binary Tree with node structure

class Node:
    """
    Node data structure for a red black tree.
    """

    def __init__(self, data=None, left=None, right=None):
        """
        Initialize data members: data, left, right.
        """

        self.data = data
        self.left = left
        self.right = right


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

        if not self.find(root, data):
            return None
        else:  # data value is found in tree
            pass

    def find(self, root, data):
        """
        Find the value 'data' in the tree. Return none if value is not found.
        """

        if root is None:
            return False
        else:
            if data is root.data:
                return True
            else:
                if data < root.data:
                    return self.find(root.left, data)
                else:
                    return self.find(root.right, data)

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

    def _insert(self, root, node):
        """
        Recursively add the node into tree with root 'root'.
        """

        if node.data < root.data:
            if root.left is None:
                root.left = node
            else:
                self._insert(root.left, node)
        else:
            if root.right is None:
                root.right = node
            else:
                self._insert(root.right, node)

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

    if test.find(test.root, 13):
        print "Found"
    if not test.find(test.root, 2):
        print "2 not found."

    print test.size(test.root)
    print test.max_depth(test.root)
