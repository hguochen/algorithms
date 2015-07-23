# Construct Binary Tree from Preorder and Inorder Traversal


class Node(object):
    def __init__(self, data):
        self.data = data
        self.left = None
        self.right = None


class Solution(object):
    def build_tree(self, preorder, inorder):
        return self.build_tree_rec(preorder, inorder, 0, 0, len(preorder))

    def build_tree_rec(self, preorder, inorder, pre_i, in_i, num_elements):
        if num_elements == 0:
            return None
        node = Node(preorder[pre_i])
        left_elements_count = 0
        for i in xrange(in_i, in_i + num_elements):
            if inorder[i] == preorder[pre_i]:
                break
            left_elements_count += 1
        node.left = self.build_tree_rec(preorder, inorder, pre_i+1, in_i, left_elements_count)
        node.right = self.build_tree_rec(preorder, inorder, pre_i+left_elements_count+1, in_i+left_elements_count+1, num_elements-left_elements_count-1)
        return node

    def build_tree2(self, postorder, inorder):
        if len(postorder) == 0:
            return
        node = Node(postorder[-1])
        if len(postorder) == 1:
            return node
        node_index = inorder.index(postorder[-1])
        left_inorder = inorder[:node_index]
        right_inorder = inorder[node_index+1:]
        left_postorder = postorder[:len(left_inorder)]
        right_postorder = postorder[len(left_inorder):-1]

        node.left = self.build_tree2(left_postorder, left_inorder)
        node.right = self.build_tree2(right_postorder, right_inorder)
        return node


def search(new_list, data):
    for i in xrange(len(new_list)):
        if new_list[i] == data:
            return i
    return


def print_inorder(root):
    if root is None:
        return
    print_inorder(root.left)
    print root.data,
    print_inorder(root.right)
    return

if __name__ == "__main__":
    in_list = "DBEAFC"
    pre_list = "ABDECF"
    post_list = "DEBFCA"
    soln = Solution()
    print_inorder(soln.build_tree(pre_list, in_list))
    print ""
    print_inorder(soln.build_tree2(post_list, in_list))
