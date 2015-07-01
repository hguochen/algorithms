class Node(object):
    """

    Node structure for Binary search tree nodes.

    """
    def __init__(self, data=None, left=None, right=None):
        self.data = data
        self.left = left
        self.right = right


class BinarySearchTree(object):
    """

    Implementation of binary search tree with node structure.

    """
    def __init__(self, data=None):
        self.root = Node(data)

    def get_root(self):
        return self.root

    def insert(self, data):
        if self.root.data is None:
            self.root.data = data
        else:
            node = Node(data)
            self._insert_node(self.root, node)
        return

    def _insert_node(self, root, node):
        if node.data < root.data:
            if root.left is None:
                root.left = node
            else:
                self._insert_node(root.left, node)
        else:
            if root.right is None:
                root.right = node
            else:
                self._insert_node(root.right, node)
        return

    def print_tree(self, node):
        print node.data,
        return

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

if __name__ == "__main__":
    tree = BinarySearchTree(25)
    root = tree.get_root()
    tree.insert(15)
    tree.insert(50)
    tree.insert(15)
    tree.insert(50)
    tree.insert(10)
    tree.insert(22)
    tree.insert(35)
    tree.insert(70)
    tree.insert(4)
    tree.insert(12)
    tree.insert(18)
    tree.insert(24)
    tree.insert(31)
    tree.insert(44)
    tree.insert(66)
    tree.insert(90)
    print "preorder: ",
    tree.preorder(root, tree.print_tree)
    print ""
    print "inorder: ",
    tree.inorder(root, tree.print_tree)
    print ""
    print "postorder: ",
    tree.postorder(root, tree.print_tree)
    print ""
    print "levelorder: ",
    tree.levelorder(root, tree.print_tree)
    print ""
