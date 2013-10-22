#include <iostream>
#include <fstream>
#include <cstring>
#include <sstream>
#include <vector>
#include <locale>
#include <cstdlib>
#include <map>

using namespace std;

string hexStringToDec( std::string str );
string extractstr_1b ( std::string str );
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
//	int ARP_target = 0;
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

	//declare packet frames for ARP datagram header
	std::string ARPHwType;
	std::string ARPProtocolType;
	std::string ARPHwLen;
	std::string ARPProtocolLen;
	std::string ARPOp;
	std::string ARPSrcHwAddr;
	std::string ARPSrcIPAddr;
	std::string ARPDstHwAddr;
	std::string ARPDstIPAddr;

	//declare container for ARP packet details
	map<int, vector<std::string> > ARP_table;
	map<int, vector<std::string> >::iterator itrV;
	vector<std::string> temp_table, temp_table2;
	int tgt_mac = 0;
	std::string ARPSrcHwAddr_final, ARPSrcHwAddr_b[6];
	std::string ARPSrcIPAddr_final, ARPSrcIPAddr_b[4];
	std::string ARPDstHwAddr_final, ARPDstHwAddr_b[6];
	std::string ARPDstIPAddr_final, ARPDstIPAddr_b[4];

	infile.open(argv[1]);

	while(!infile.eof()) {
		getline(infile, string);

		//go to next getline if string is empty file
		if(string == "") {
			if(pkt_start == 1) {
				pkt_end = 1;
			}
		} else {
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

					//get ARPHwType
					ARPHwType = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );
					
					//get ARPProtocolType
					ARPProtocolType = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2 );
					
					//get ARPHwLen
					ARPHwLen = extract_1b(packet);
					packet.erase ( packet.begin() );

					//get ARPProtocolLen
					ARPProtocolLen = extract_1b(packet);
					packet.erase ( packet.begin() );

					//get ARPOp
					ARPOp = extract_2b(packet);
					packet.erase ( packet.begin(), packet.begin()+2);

					//get ARPSrcHwAddr
					ARPSrcHwAddr = extract_6b(packet);
					packet.erase ( packet.begin(), packet.begin()+6);
					
					//get ARPSrcIPAddr
					ARPSrcIPAddr = extract_4b(packet);
					packet.erase ( packet.begin(), packet.begin()+4);

					//get ARPDstHwAddr
					ARPDstHwAddr = extract_6b(packet);
					packet.erase ( packet.begin(), packet.begin()+6);

					//get ARPDstIPAddr
					ARPDstIPAddr = extract_4b(packet);
					packet.erase ( packet.begin(), packet.begin()+4);

					if(ARPOp == "0002") {
						//Set ARPSrcHwAddr_final
						std::string ARPSrcHwAddr_temp = ARPSrcHwAddr; 
						for (int k = 0; k <6; k++) {
							ARPSrcHwAddr_b[k] = extractstr_1b(ARPSrcHwAddr_temp);
							ARPSrcHwAddr_temp.erase(ARPSrcHwAddr_temp.begin(), ARPSrcHwAddr_temp.begin()+2);
						}
						ARPSrcHwAddr_final = ARPSrcHwAddr_b[0] + ":" + ARPSrcHwAddr_b[1] + ":" + ARPSrcHwAddr_b[2] + ":" + ARPSrcHwAddr_b[3] + ":" + ARPSrcHwAddr_b[4] + ":" + ARPSrcHwAddr_b[5]; 
						
						//Set ARPSrcIPAddr_final
						std::string ARPSrcIPAddr_temp = ARPSrcIPAddr;
						for (int k = 0; k <4; k++) {
							ARPSrcIPAddr_b[k] = extractstr_1b(ARPSrcIPAddr_temp);
							ARPSrcIPAddr_temp.erase(ARPSrcIPAddr_temp.begin(), ARPSrcIPAddr_temp.begin()+2);

						}

					    for(int k = 0; k < 4; k++) {
					    	ARPSrcIPAddr_b[k] = hexStringToDec(ARPSrcIPAddr_b[k]);
					    }
					    ARPSrcIPAddr_final = ARPSrcIPAddr_b[0] + "." + ARPSrcIPAddr_b[1] + "." + ARPSrcIPAddr_b[2] + "." + ARPSrcIPAddr_b[3];
						
						//Set ARPDstHwAddr_final
						std::string ARPDstHwAddr_temp = ARPDstHwAddr; 
						for (int k = 0; k <6; k++) {
							ARPDstHwAddr_b[k] = extractstr_1b(ARPDstHwAddr_temp);
							ARPDstHwAddr_temp.erase(ARPDstHwAddr_temp.begin(), ARPDstHwAddr_temp.begin()+2);
						}
						ARPDstHwAddr_final = ARPDstHwAddr_b[0] + ":" + ARPDstHwAddr_b[1] + ":" + ARPDstHwAddr_b[2] + ":" + ARPDstHwAddr_b[3] + ":" + ARPDstHwAddr_b[4] + ":" + ARPDstHwAddr_b[5]; 
						
						//Set ARPDstIPAddr_final
						std::string ARPDstIPAddr_temp = ARPDstIPAddr;
						for (int k = 0; k <4; k++) {
							ARPDstIPAddr_b[k] = extractstr_1b(ARPDstIPAddr_temp);
							ARPDstIPAddr_temp.erase(ARPDstIPAddr_temp.begin(), ARPDstIPAddr_temp.begin()+2);

						}

					    for(int k = 0; k < 4; k++) {
					    	ARPDstIPAddr_b[k] = hexStringToDec(ARPDstIPAddr_b[k]);
					    }
					    ARPDstIPAddr_final = ARPDstIPAddr_b[0] + "." + ARPDstIPAddr_b[1] + "." + ARPDstIPAddr_b[2] + "." + ARPDstIPAddr_b[3];
						
						if(ARP_table.empty() && ARPDstHwAddr_final != "") {
							//fill in the first entry
							temp_table.push_back(ARPDstHwAddr_final);
							temp_table.push_back(ARPDstIPAddr_final);
							temp_table.push_back(ARPSrcHwAddr_final);
							temp_table.push_back(ARPSrcIPAddr_final);

							ARP_table.insert( pair<int, vector<std::string> >(tgt_mac, temp_table) );
							tgt_mac++;
							temp_table.clear();
//							cout << ARP_table.size() <<" is arp table size." <<endl;

						} else { //ARP_table is not empty, comparison starts
							//check against existing entries
							for(itrV = ARP_table.begin(); itrV !=ARP_table.end(); itrV++) {

								temp_table = itrV->second;

								if(temp_table.at(2) !=ARPSrcHwAddr_final && temp_table.at(3) != ARPSrcIPAddr_final) {
									temp_table2.push_back(ARPDstHwAddr_final);
									temp_table2.push_back(ARPDstIPAddr_final);
									temp_table2.push_back(ARPSrcHwAddr_final);
									temp_table2.push_back(ARPSrcIPAddr_final);

									ARP_table.insert( pair<int, vector<std::string> >(tgt_mac, temp_table2) );
									tgt_mac++;
									temp_table2.clear();
								}
								temp_table.clear();
							}
						}						
//						cout << ARPDstHwAddr_final << endl;
//						cout << ARPDstIPAddr_final << endl;
//					    cout << ARPSrcHwAddr_final << endl;
//						cout << ARPSrcIPAddr_final << endl;
					} 
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
	cout << "total number of ARP packets = "<< ARP_count <<endl;
	cout << "total number of ARP targets = "<< ARP_table.size()<<endl;
	cout << "No." << "         "<< "src_mac" <<"          " << "src_ip" <<"          "<< "target_mac" <<"          "<< "target_ip" <<endl;
	
	for(itrV = ARP_table.begin(); itrV !=ARP_table.end(); itrV++) {
		temp_table = itrV->second;

		cout << itrV->first +1<<"      "<< temp_table.at(0) <<"   "<< temp_table.at(1)<<"   "<< temp_table.at(2)<< "    "<< temp_table.at(3) <<endl;
	}

	return 0;
}

string hexStringToDec (std::string str) { 
  const char* charType;

  charType = str.c_str();

  int i = strtoul (charType, NULL, 16);
  std::stringstream ss;
  ss << i;
   
  return ss.str();
}

string extractstr_1b (std::string str) {
	std::string str_1b;
	
	str_1b = str.substr(0, 2);

	return str_1b;
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