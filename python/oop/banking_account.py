class Customer(object):
    """

    A customer of ANC Bank with a checking account. Customers have the
    following properties:

    Attributes:

    name: a string representing the customer's name
    balance: a float tracking the current balance of the customer's account.

    """
    def __init__(self, name, balance=0.0):
        self.name = name
        self.balance = balance

    def withdraw(self, amount):
        """

        Return the balance remaining after withdrawing *amount* dollars.

        """
        if amount > self.balance:
            raise RuntimeError('Amount greater than available balance')
        self.balance -= amount
        return self.balance

    def deposit(self, amount):
        """

        Return the balance remaining after depositing *amount* dollars.

        """
        self.balance += amount
        return self.balance


if __name__ == "__main__":
    cust = Customer('roger', 500)
    print cust.deposit(2000)
    print cust.withdraw(5000)
    print cust.withdraw(200)
