# Given a binary search tree, design an algorithm which creates a linked list
# of all the nodes at each depth.
# ie. if you have a tree with depth D, you'll have D linked lists.
#

from ADT.binary_search_tree_revisit import *


def LinkedList(object):
    def __init__(self, data, next=None):
        self.data = data
        self.next = next


def bst_to_linkedlist(bst):
    """
    Take in a binary search tree object and return a linked list of all the
    nodes at each depth.

    """


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
    tree.print_levelorder(root)
