class Node(object):
    """

    Node sturcture for binary search tree.

    """
    def __init__(self, data=None, left=None, right=None):
        self.data = data
        self.left = left
        self.right = right


class BinarySearchTree(object):
    """

    Implementation of Binary search tree with node structure.

    """
    def __init__(self, data=None):
        self.root = Node(data)

    def preorder(self, node, callback):
        if node is None:
            return
        callback(node)
        self.preorder(node.left, callback)
        self.preorder(node.right, callback)
        return

    def inorder(self, node, callback):
        if node is None:
            return
        self.inorder(node.left, callback)
        callback(node)
        self.inorder(node.right, callback)
        return

    def postorder(self, node, callback):
        if node is None:
            return
        self.postorder(node.left, callback)
        self.postorder(node.right, callback)
        callback(node)
        return

    def levelorder(self, node, callback):
        if node is None:
            return
        queue = [node]
        while len(queue) > 0:
            trav = queue.pop(0)
            callback(trav)
            if trav.left is not None:
                queue.append(trav.left)
            if trav.right is not None:
                queue.append(trav.right)
        return
