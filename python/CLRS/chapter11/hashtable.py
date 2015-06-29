class Table(object):
    """

    Implementation of Hash table.

    """
    def __init__(self):
        self.table = [0 for _ in xrange(11)]

    def insert(self, value):
        self.table[self.hashcode(value)] = [self.hashcode(value), value]

    def hashcode(self, value):
        return value % len(self.table)

    def search(self, value):
        return self.table[self.hashcode(value)]

    def delete(self, value):
        return self.table.pop(self.hashcode(value))


if __name__ == "__main__":
    table = Table()
    table.insert(15)
    table.insert(14)
    table.insert(13)
    table.insert(43)
    print table.search(14)
    print table.delete(13)
    print table.table
