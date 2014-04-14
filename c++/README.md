## Network Traffic and Packet Format Analysis

Developed on Ubuntu 11.10 and Linux OS. 

A program used to identify the amount and types of network traffic data packets sent over the internet.

To compile code in terminal:

	$ g++ -Wall -o count count.cpp
	
Similarly, for `arp.cpp` and `ping.cpp`

	$ g++ -Wall -o arp arp.cpp
	$ g++ -Wall -o ping ping.cpp
	
To run code in the terminal:

	$ ./count hex_new.dat
	
The "hext_new.dat" file could be replaced with other input packets in .dat format. Similarly, for `arp.cpp` and `ping.cpp`

	$ ./arp hex_new.dat
	$ ./ping hex_new.dat
	
Given input packet `hex_new.dat`, output are as follows:

	$ ./count hex_new.dat
	
	total number of ETHERNET packets	= 4021	total number of IP packets			= 4011	total number of ARP packets			= 10	total number of ICMP packets		= 1098	total number of TCP packets			= 1645	total number of UDP packets			= 1262	total number of Ping packets		= 1097 	total number of DHCP packets		= 14	total number of DNS packets			= 1171`arp.cpp`
* Print out the number of ARP packets(both requests and responses), the total number of different target addresses and the received ARP replies for each target address.
		$ ./arp hex_new.dat		total number of ARP packets = 10		total number of ARP targets = 1		No.         src_mac          	src_ip          target_mac        target_ip		1      00:22:68:c3:b8:fd   172.18.182.155   00:00:0c:07:ac:00    172.18.182.1`ping.cpp`
* Print out the total number of Ping packets, the total number of Ping sessions and details of the Ping sessions(source/destination IP, session ID, and the number of echo requests and echo replies).
		$ ./ping hex_new.dat		total number of Ping packets = 1097		total number of Ping sessions = 5		No.           src_ip                src_ip            id       num_req num_rep		1         172.18.182.155         203.208.248.10      241d         7         0		2         172.18.182.155         203.116.221.50      251d         3         0		3         172.18.182.155         98.137.149.56       261d        147       142		4         172.18.182.155         216.239.61.104      c51c        217       209		5         172.18.182.155         216.239.61.104      e51c        186       186