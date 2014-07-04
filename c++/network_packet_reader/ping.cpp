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



	//declare packet frames for PING frame header
//	int PING_sessions = 0;
	std::string ICMP_id;
	std::string ICMP_seq;

	//declare container for ping packet details
	map<std::string, vector<std::string> > PING_table;
	map<std::string, vector<std::string> >::iterator itrM, itrP;
	vector<std::string> temp_PingTable, temp_PingTable2;
	map<std::string, vector<int> > PING_reqrep_table;
	map<std::string, vector<int> >::iterator itrN;
	vector<int> temp_rrtable;
	int request = 0;
	int reply = 0;
	int testForNewEntry = 0;
	std::string PINGSrcIP_final, PINGSrcIP_b[4];
	std::string PINGDstIP_final, PINGDstIP_b[4];


	//open file
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

							ICMP_id = extract_2b(packet);
							packet.erase ( packet.begin(), packet.begin()+2 );

							ICMP_seq = extract_2b(packet);
							packet.erase ( packet.begin(), packet.begin()+2 );

							//convert id. id is already correct syntax

//							cout << ICMP_id<<endl;
							//set PINGSrcIP_final
							std::string PINGSrcIP_temp = SrcIP;
							for (int k = 0; k <4; k++) {
								PINGSrcIP_b[k] = extractstr_1b(PINGSrcIP_temp);
								PINGSrcIP_temp.erase(PINGSrcIP_temp.begin(), PINGSrcIP_temp.begin()+2);
							}
							for(int k = 0; k < 4; k++) {
					    		PINGSrcIP_b[k] = hexStringToDec(PINGSrcIP_b[k]);
					    	}
					    	
					    	PINGSrcIP_final = PINGSrcIP_b[0] + "." + PINGSrcIP_b[1] + "." + PINGSrcIP_b[2] + "." + PINGSrcIP_b[3];
							
//							cout << PINGSrcIP_final <<" this is ping src_ip." <<endl;
							
							//set PINGDstIP_final
							std::string PINGDstIP_temp = DstIP;
							for (int k = 0; k <4; k++) {
								PINGDstIP_b[k] = extractstr_1b(PINGDstIP_temp);
								PINGDstIP_temp.erase(PINGDstIP_temp.begin(), PINGDstIP_temp.begin()+2);
							}
							for(int k = 0; k < 4; k++) {
					    		PINGDstIP_b[k] = hexStringToDec(PINGDstIP_b[k]);
					    	}

					    	PINGDstIP_final = PINGDstIP_b[0] + "." + PINGDstIP_b[1] + "." + PINGDstIP_b[2] + "." + PINGDstIP_b[3];
							
//							cout << PINGDstIP_final <<" this is ping dst_ip." <<endl;

//							cout << "ICMP_id IS THIS::: "<<ICMP_id<<endl;
							if(PING_table.empty() ) {
//								cout << "test1" <<endl;
								//fill in the first entry
								temp_PingTable.push_back(PINGSrcIP_final);
								temp_PingTable.push_back(PINGDstIP_final);
								PING_table.insert( pair<std::string, vector<std::string> >(ICMP_id, temp_PingTable) );
								temp_PingTable.clear();

								//fill in the PING_reqrep_table
								if(ICMPType == "0008") {
									temp_rrtable.push_back(request);
									temp_rrtable.push_back(1);
								} else {
									temp_rrtable.push_back(1);
									temp_rrtable.push_back(reply);
								}
								PING_reqrep_table.insert( pair<std::string, vector<int> > (ICMP_id, temp_rrtable) );
								temp_rrtable.clear();
//								cout << "test2" <<endl;
							} else { //PING_table is not empty, comparison starts
//								cout << "test3" <<endl;
								//check against existing entries
								for(itrM = PING_table.begin(); itrM !=PING_table.end(); itrM++) {
//									cout << "test4" <<endl;
									temp_PingTable = itrM->second;

									if(ICMP_id != itrM->first) {
										//traverse the PING_table and check other entries
										//add the entry only if id does not match any of the entry
										for(itrP = PING_table.begin(); itrP !=PING_table.end(); itrP++) {
											if(ICMP_id != itrP->first) {
//											cout<<"test for 4.1"<<endl;
												testForNewEntry = 1;
											} else {
//											cout <<"test for 4.2" <<endl;
												testForNewEntry = 0;
											}
										}
										//testForNewEntry++;
//										cout<< "test for 4.3" <<endl;
										
										//continue;
									} else {
//										cout << "test5" <<endl;
										//ICMP_id == itrM->first
										//cross check for SrcIP and DstIP
										//if direct match, req++;
										//if indirect match, rep++; 

										if(temp_PingTable.at(0) == PINGSrcIP_final && temp_PingTable.at(1) == PINGDstIP_final) {
//											cout << "test6" <<endl;
											//request++;
											for(itrN = PING_reqrep_table.begin(); itrN !=PING_reqrep_table.end(); itrN++) {
												temp_rrtable = itrN->second;
												//update PING_reqrep_table
												if(ICMP_id == itrN->first) {
													temp_rrtable.at(0) = temp_rrtable.at(0) + 1;
													PING_reqrep_table[ICMP_id] = temp_rrtable;
												}
//												cout << itrN->first << "is table key, its values are" << temp_rrtable.at(0) << " and "<< temp_rrtable.at(1) <<endl;
												temp_rrtable.clear();
											}
										}
										if(temp_PingTable.at(0) == PINGDstIP_final && temp_PingTable.at(1) == PINGSrcIP_final) {
//											cout << "test7" <<endl;
											//reply++;
											for(itrN = PING_reqrep_table.begin(); itrN !=PING_reqrep_table.end(); itrN++) {
												temp_rrtable = itrN->second;
												//update PING_reqrep_table
												if(ICMP_id == itrN->first) {
													temp_rrtable.at(1) = temp_rrtable.at(1) + 1;
													PING_reqrep_table[ICMP_id] = temp_rrtable;
												}
//												cout << itrN->first << "is table key, its values are" << temp_rrtable.at(0) << " and "<< temp_rrtable.at(1) <<endl;
												temp_rrtable.clear();
											}
										}
//										cout << "test8" <<endl;
									}
									temp_PingTable.clear();
								}
//								cout << "test9" <<endl;
								//if new entry is 0, add new entry
								if(testForNewEntry == 1) {
//									cout << "test10" <<endl;
									//add new entry
									temp_PingTable.push_back(PINGSrcIP_final);
									temp_PingTable.push_back(PINGDstIP_final);	
									PING_table.insert( pair<std::string, vector<std::string> >(ICMP_id, temp_PingTable) );								
									temp_PingTable.clear();

									//fill in the PING_reqrep_table
									if(ICMPType == "0008") {
										temp_rrtable.push_back(request);
										temp_rrtable.push_back(1);
									} else {
										temp_rrtable.push_back(1);
										temp_rrtable.push_back(reply);
								}
									PING_reqrep_table.insert( pair<std::string, vector<int> > (ICMP_id, temp_rrtable) );
									temp_rrtable.clear();

									testForNewEntry = 0;
								}	
							}							
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

	cout << "total number of Ping packets = "<< PING_count <<endl;
	cout << "total number of Ping sessions = "<< PING_reqrep_table.size() <<endl;
	cout << "No." << "           "<< "src_ip" <<"                " << "src_ip" <<"            "<< "id"<<"       "<<"num_req"<<"   "<<"num_rep"<<endl;

	int no = 1;
	itrN = PING_reqrep_table.begin();
	//use itrP for PIN_table, itrN for PING_reqrep_table
	for(itrP = PING_table.begin(); itrP !=PING_table.end(); itrP++) {
		temp_PingTable = itrP->second;
		
		while( itrN !=PING_reqrep_table.end()) {
			temp_rrtable = itrN->second;

		cout << no << "         "<< temp_PingTable.at(0) <<"         "<< temp_PingTable.at(1) <<"      ";

		if(no == 3) {
			cout << " ";
		}
		cout << itrP->first<<"         ";

		if(no >= 3) {
			cout << "\b";
		}
		cout << temp_rrtable.at(0) <<"         ";

		if(no >= 3) {
			cout << "\b\b";
		}
		cout<< temp_rrtable.at(1);
		break;
		}
		itrN++;
		cout <<endl;
		no++;
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