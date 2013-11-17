import java.util.Scanner;
import java.util.Arrays;
import java.lang.Math;

class Coupon {
	//Attributes
	private String name;
	private double rate;

	//Constructors
	public Coupon() {}
	public Coupon(String new_name, double new_rate) {
		this.name = new_name;
		this.rate = new_rate;
	}

	//Accessors 
	public String getName() {
		return this.name;
	}
	public double getRate() {
		return this.rate;
	}
	//Methods
	public double payment(double price) {
		double pay =0.0;
		if (this.rate < 1) { //discount coupon
			pay = (1-rate) * price;
		} else { //cash coupon
			if (price > this.rate) {
				pay = this.rate - price;
			} else {
				pay = price - this.rate;
			}
		}
		return pay;
	}

}

class Redeem {
	public static void main(String[] args) {
		//Declare a scanner object to read input
		Scanner scan = new Scanner(System.in);
		//Declare the necessary variables
		double price, pay, rate; 
		int num_coupon;
		String name;
		
		//Read input and process them accordingly
		price = scan.nextDouble();
		num_coupon = scan.nextInt();

		for (int i=0; i < num_coupon; i++) {
			name = scan.next();
			rate = scan.nextDouble();
			Coupon[] coupon[i] = new Coupon(name, rate);
			System.out.println(coupon[i].getName);
			System.out.println(coupon[i].getRate);
		}
		
		//System.out.println(discount_coupon[0]);
		//Ensure your output is in the right format
	}

	//Utility methods
	public static double[] deleteFromArray(double[] array, int delete) {
    	double[] x = new double[array.length-1];
		int k = 0;
   		for(int i = 0; i < array.length; i++) {
        	if(i != delete)
         		x[k++] = array[i];
   		}
   		return x;
	}
}