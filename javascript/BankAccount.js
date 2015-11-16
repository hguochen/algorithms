// constructor for BankAccount class
function BankAccount() {
    this.balance = 0.0;
}

BankAccount.prototype.getBalance = function(amount) {
    console.log('Balance: ' + this.balance);
    return this.balance;
};

BankAccount.prototype.deposit = function(amount) {
    if (amount <= 0.0) {
        console.log('Cannot deposit a negative amount');
        return;
    }
    console.log('Deposit: ' + amount);
    this.balance = this.balance + amount;
};

BankAccount.prototype.withdraw = function(amount) {
    if (amount <= 0.0) {
        console.log('Cannot withdraw an amount greater than the existing balance');
        return;
    }
    if (amount > this.balance) {
        console.log('Cannot withdraw an amount greater than the existing balance');
        return;
    }
    console.log('Withdraw: ' + amount);
    this.balance = this.balance - amount;
};

account = new BankAccount();
account.deposit(100.00);
account.withdraw(10.00);
account.getBalance();