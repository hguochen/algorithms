import java.util.*;

class BinaryNode {
	public int data;
	public BinaryNode leftChild;
	public BinaryNode rightChild;

	public BinaryNode(int value) {
		this.data = value;
	}
}

public class BinaryTree {
	public BinaryNode root;

	public BinaryTree(int rootValue) {
		root = new BinaryNode(rootValue);
	}

	public void addNode(BinaryNode node, int value) {
		if (node.data > value) { //leftChild
			if (node.leftChild != null) {
				addNode(node.leftChild, value);
			} else {				
				BinaryNode newNode = new BinaryNode(value);
				node.leftChild = newNode;
				System.out.println("Added " + value + " as a left child of " + node.data);
			}
		} else { // rightChild
			if (node.rightChild != null) {
				addNode(node.rightChild, value);
			} else {
				BinaryNode newNode = new BinaryNode(value);
				node.rightChild = newNode;
				System.out.println("Added " + value + " as a right child of " + node.data);
			}
		}
	}

	public void preorder(BinaryNode node) {
		if (node != null) {
			System.out.print(node.data + " ");
			preorder(node.leftChild); // traverse left subtree
			preorder(node.rightChild); // traverse right subtree
		}
	}

	public void inorder(BinaryNode node) {
		if (node == null) {
			return;
		}
		inorder(node.leftChild);
		System.out.print(node.data + " ");
		inorder(node.rightChild);
	}

	public void postorder(BinaryNode node) {
		if (node == null) {
			return;
		}
		postorder(node.leftChild);
		postorder(node.rightChild);
		System.out.print(node.data + " ");
	}

	public int countNodes(BinaryNode node) {
		// Returns the number of nodes in the binary tree with root.
		if (node == null) {
			return 0;
		}
		int count = 1;
		count = count + countNodes(node.leftChild); // add in nodes in left subtree
		count = count + countNodes(node.rightChild); // add in nodes in right subtree
		return count;
	}

	public static void main(String[] args) {
		BinaryTree tree = new BinaryTree(5);
		tree.addNode(tree.root, 3);
		tree.addNode(tree.root, 4);
		tree.addNode(tree.root, 9);
		tree.addNode(tree.root, 7);
		tree.addNode(tree.root, 6);
		tree.addNode(tree.root, 8);
		tree.preorder(tree.root);
		System.out.println();
		System.out.println("Total number of nodes: " + tree.countNodes(tree.root));
		tree.inorder(tree.root);
		System.out.println();
		tree.postorder(tree.root);
		System.out.println();
	}
}
