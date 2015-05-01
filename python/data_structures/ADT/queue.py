import unittest


class Queue(object):
    """

    Implmenting a queue with list data structure.

    """
    def __init__(self, queue=list()):
        self.queue = queue

    def enqueue(self, value):
        self.queue.append(value)

    def dequeue(self):
        self.queue.pop(0)


class QueueTestCase(unittest.TestCase):
    def setUp(self):
        self.queue1 = Queue()

    def test_queue(self):
        self.queue1.enqueue(1)
        self.queue1.enqueue(2)
        self.queue1.enqueue(3)
        self.queue1.enqueue(4)
        self.assertEqual(self.queue1.queue, [1, 2, 3, 4])
        self.queue1.dequeue()
        self.queue1.dequeue()
        self.assertEqual(self.queue1.queue, [3, 4])


if __name__ == "__main__":
    unittest.main()
