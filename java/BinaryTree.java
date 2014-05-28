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

	public static void main(String[] args) {
		BinaryTree tree = new BinaryTree(5);
		tree.addNode(tree.root, 3);
		tree.addNode(tree.root, 7);
		tree.addNode(tree.root, 2);
		tree.addNode(tree.root, 9);
		tree.addNode(tree.root, 6);
	}
}
