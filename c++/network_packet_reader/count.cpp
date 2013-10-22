#include <iostream>
#include <fstream>
#include <cstring>
#include <sstream>
#include <vector>
#include <locale>
#include <cstdlib>
#include <map>

using namespace std;

int hexStringToDec( std::string str );
string extract_1b (vector<std::string> packet);
string extract_2b (vector<std::string> packet);
string extract_4b (vector<std::string> packet);
string extract_6b (vector<std::string> packet);

int main(int argc, char* argv[]) {
	string string, offset, dataByte_1;
	ifstream infile;
	unsigned i = 0;
	int pkt_start = 0;
	int pkt_end = 0;
	vector<std::string> packet;
	int packetCount = 0; //number of packets in total

	//declare counters for each type of packet
	int ETHERNET_count = 0;
	int IP_count = 0;
	int ARP_count = 0;
	int ICMP_count = 0;
	int TCP_count = 0;
	int UDP_count = 0;
	int PING_count = 0;
	int DHCP_count = 0;
	int DNS_count = 0;

	//declare storage for each type of packets
	map<int, vector<std::string> > ETHERNET_pkt;
	map<int, vector<std::string> > IP_pkt;
	map<int, vector<std::string> > ARP_pkt;
	map<int, vector<std::string> > ICMP_pkt;
	map<int, vector<std::string> > TCP_pkt;
	map<int, vector<std::string> > UDP_pkt;
	map<int, vector<std::string> > PING_pkt;
	map<int, vector<std::string> > DHCP_pkt;
	map<int, vector<std::string> > DNS_pkt;

	//declare packet frames for MAC header
	std::string DstAddr;
	std::string SrcAddr;
	std::string type;

	//declare packet frames for IP datagram header
	std::string VerHlen;
	std::string ServiceType;
	std::string TotalLen;
	std::string Id;
	std::string FlagNOffset;
	std::string TTL;
	std::string Protocol;
	std::string CheckSum;
	std::string SrcIP;
	std::string DstIP;

	//declare packet frames for ICMP datagram header
	std::string ICMPType;
	std::string ICMPCode;
	std::string ICMPCheckSum;

	//declare packet frames for UDP datagram header
	std::string UDPSrcPort;
	std::string UDPDstPort;
	std::string UDPLen;
	std::string UDPCheckSum;

	infile.open(argv[1]);

	while(!infile.eof()) {
		getline(infile, string);

		//go to next getline if string is empty file
		if(string == "") {
			if(pkt_start == 1) {
				pkt_end = 1;
			}

		} else { //is not an empty line
			string.resize(54); 
		}
		
		if(string != "") {
			istringstream line(string);

			line >> offset;
			i = i + offset.size() + 2; //2 for 2 spaces after offset

			if(offset == "0000") {
				pkt_start = 1;
			}

			do {

				line >> dataByte_1;
				i = i + dataByte_1.size() + 1;
				packet.push_back(dataByte_1);

			} while ( i < string.size() );
			i = 0; 
		}
		//store 2 counter a, b. initialized to 0. counter a = 1 when an empty line is read, 
		//counter b = 1 when a offset 0000 is read. when a, b = 1. means a whole packet is stored 
		//packet vector. use a,b as condition to start processing the packet			
		if(pkt_start == 1 && pkt_end == 1) {
			packetCount++;

			//start analyzing packet from here
			if(!packet.empty()) {

				//get DstAddr and remove dstAddr frame from packet
				DstAddr = extract_6b(packet);
				packet.erase( packet.begin(), packet.begin()+6 );

				//get SrcAddr and remove dstaddr frame from packet
				SrcAddr = extract_6b(packet);
				packet.erase ( packet.begin(), packet.begin()+6 );

				//get type and remove type frame from packet
				type = extract_2b(packet);
				packet.erase ( packet.begin(), packet.begin()+2 );

				//identify ARP packets
				if(type == "0806") {

					ETHERNET_count++;
					ARP_count++;
				}

				//identify IP packets
				if(type == "0800") {

					ETHERNET_count++;
					IP_count++;
					//get VerHlen
					VerHlen = extract_1b(packet);
					packet.erase ( packet.begin() );
					
					//get ServiceType
					ServiceType = extract_1b(packet);
					packet.erase ( packet.begin() );
					
					//get TotalLen
					TotalLen = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );
					
					//get Id
					Id = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );

					//get FlagNOffset
					FlagNOffset = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );

					//get TTL
					TTL = extract_1b(packet);
					packet.erase ( packet.begin() );

					//get Protocol
					Protocol = extract_1b(packet);
					packet.erase ( packet.begin() );

					//get Checksum
					CheckSum = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );

					//get SrcIP
					SrcIP = extract_4b(packet);
					packet.erase ( packet.begin(), packet.begin()+4 );

					//get DstIP
					DstIP = extract_4b(packet);
					packet.erase ( packet.begin(), packet.begin()+4 );
					
					// convert header length to decimal
					int nVerHlen = hexStringToDec(VerHlen);

					//check if header len together with version is equal to 69
					//go into if stmts if the len is bigger than 69
					if(nVerHlen > 69 && nVerHlen < 109) {
						// no of optionsbyte in it
						int optionsByte = nVerHlen - 69;

						//clear the options byte
						for(int a = 0; a < optionsByte; a++) {
							packet.erase(packet.begin());
						}
					}

					if (Protocol == "01") {
						ICMP_count++;	
						
						//get ICMPType
						ICMPType = extract_1b(packet);
						packet.erase ( packet.begin() );
						
						//get ICMPCode
						ICMPCode = extract_1b(packet);
						packet.erase ( packet.begin() );
						
						//get ICMPCheckSum
						ICMPCheckSum = extract_2b(packet);
						packet.erase ( packet.begin(), packet.begin()+2);
						
						if (ICMPType == "00" || ICMPType == "08") {
							PING_count++;
						}					
					}
					if (Protocol == "06") {
						TCP_count++;
					}
					if (Protocol == "11") {
						UDP_count++;

						//get UDPSrcPort
						UDPSrcPort = extract_2b(packet);
						packet.erase ( packet.begin(), packet.begin()+2 );
						//get UDPDstPort
						UDPDstPort = extract_2b(packet);
						packet.erase ( packet.begin(), packet.begin()+2 );
						//get UDPLen
						UDPLen = extract_2b(packet);
						packet.erase ( packet.begin(), packet.begin()+2 );
						//get UDPCheckSum
						UDPCheckSum = extract_2b(packet);
						packet.erase ( packet.begin(), packet.begin()+2 );

						if(UDPSrcPort == "0044" || UDPSrcPort == "0043") {
							if(UDPDstPort == "0044" || UDPDstPort == "0043") {
								DHCP_count++;
							}
						}
						if(UDPSrcPort =="0035" || UDPDstPort == "0035") {
							DNS_count++;
						}
					} 
				}
			}
			packet.clear();
			pkt_start = 0;
			pkt_end = 0;
		}
	}
	
	cout << "total number of ETHERNET packets =  "<< ETHERNET_count <<endl;
	cout << "total number of IP packets = "<< IP_count <<endl;
	cout << "total number of ARP packets = "<< ARP_count <<endl;
	cout << "total number of ICMP packets = "<< ICMP_count <<endl;
	cout << "total number of TCP packets = "<< TCP_count <<endl;
	cout << "total number of UDP packets = "<< UDP_count <<endl;
	cout << "total number of Ping packets = "<< PING_count <<endl;
	cout << "total number of DHCP packets = "<< DHCP_count <<endl;
	cout << "total number of DNS packets = "<< DNS_count <<endl;

	return 0;
}

int hexStringToDec (std::string str) {
  const char* charType;

  charType = str.c_str();

  int i = strtoul (charType, NULL, 16);

  return i;
}

string extract_1b (vector<std::string> packet) {
  string str1;
  
  str1 = packet.front();

  return str1;
}

string extract_2b (vector<std::string> packet) {
  string str2, temp;

  for (int i = 0; i < 2; i++) {
    temp += packet.at(i);
  }
  
  str2 = temp;
    
  return str2;
}

string extract_4b (vector<std::string> packet) {
  string str4, temp;

  for (int i = 0; i < 4; i++) {
    temp += packet.at(i);
  } 

  str4 = temp;

  return str4;
}

string extract_6b (vector<std::string> packet) {
  string str6, temp;

  for(int i = 0; i < 6; i++) {
    temp += packet.at(i);
  }

  str6 = temp;

  return str6;
}