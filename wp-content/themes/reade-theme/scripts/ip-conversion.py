import ipaddress, json

with open('russia.json') as json_file:
   data = json.load(json_file)
   # for p in data['ranges']:
   #    ip_start = p['ip_start']
   #    ip_end = p['ip_end']
   #    result_cidr = ip_range_to_cidr(ip_start, ip_end)
   #    print(result_cidr)

   print(len(data))

def ip_range_to_cidr(ip_start, ip_end):
    start_ip = int(ipaddress.IPv4Address(ip_start))
    end_ip = int(ipaddress.IPv4Address(ip_end))

    # Find the common prefix length
    common_prefix_length = 32 - (start_ip ^ end_ip).bit_length()

    # Create CIDR notation
    cidr_notation = f"{ip_start}/{common_prefix_length}"

    return cidr_notation

# Example usage:
result = []
for entry in data:
   ip_start = entry[0] # "95.172.32.0"
   ip_end = entry[1] # "95.172.32.255"
   result_cidr = ip_range_to_cidr(ip_start, ip_end)
   # print(result_cidr)
   result.append(result_cidr)

with open('cidr.json', 'w') as f:
   json.dump(result, f, indent=2)

