"""
Design an algorithm and write code to find the first common ancestor of two
nodes in a binary tree. Avoid storing additional nodes in a data structure.

NOTE: This is not necessarily a binary search tree.

"""
from ADT.binary_search_tree_revisit import *


def find_ancestor_node(tree, node1, node2):
    """
    This solution uses an additional list to store the parent values and
    assumes there's a parent link to each node's parent.

    """
    # check both nodes are not root node
    root = tree.get_root()
    if node1 is root or node2 is root:
        return

    node1_parents = find_parents(node1)
    node2_parents = find_parents(node2)

    result_node = None
    for item1 in node1_parents:
        for item2 in node2_parents:
            if item1.data == item2.data:
                result_node = item1
                break
    print result_node.data
    return result_node


def find_parents(node):
    result = []
    while node.parent is not None:
        result.append(node.parent)
        node = node.parent
    return result

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
    node1 = tree.lookup(root, 1)
    node2 = tree.lookup(root, 14)
    node3 = tree.lookup(root, 13)
    tree.print_levelorder(root)
    print "\n"
    find_ancestor_node(tree, node1, node3)
