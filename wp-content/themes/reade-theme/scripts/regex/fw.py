from fuzzywuzzy import fuzz
import json
import csv
import pandas as pd

def find_best_match(source_url, destination_urls):
    best_match = None
    best_ratio = -1  # Initialize with a negative value

    for dest_url in destination_urls:
        source_path = source_url.split("/")[-1]
        dest_path = dest_url.split("/")[-1]

        ratio = fuzz.ratio(source_path, dest_path)
      #   print(ratio, source_path, dest_path, ratio)

        if ratio > best_ratio:
            best_match = dest_url
            best_ratio = ratio

    if best_ratio >= 70:
        print(best_ratio, source_url, best_match)
    return best_match if best_ratio >= 70 else None  # Adjust the ratio threshold as needed
    # return best_match if best_ratio else None  # Adjust the ratio threshold as needed

def create_redirects(source_urls, destination_urls):
    redirects = []

    used_source_urls = set()  # To keep track of used source URLs
    used_destination_urls = set()  # To keep track of used destination URLs

    for source_url in source_urls:
        if source_url not in used_source_urls:
            best_match = find_best_match(source_url, destination_urls)
            
            if best_match and best_match not in used_destination_urls:
                redirects.append((source_url, best_match))
                used_source_urls.add(source_url)
                used_destination_urls.add(best_match)
            else:
                redirects.append((source_url, None))
                used_source_urls.add(source_url)

    return redirects, used_destination_urls

# Example usage:
source_urls = {
    "https://example.com/product123",
    "https://example.com/page456",
    "https://example.com/item789"
}

destination_urls = {
    "https://example.com/productABC",
    "https://example.com/pageXYZ",
    "https://example.com/item123",
    "https://example.com/categoryA/product123",
    "https://example.com/categoryB/page456",
}



with open('scott.json', 'r') as f:
   list2 = json.load(f)


with open('parse.json', 'r') as f:
   list1 = json.load(f)

###
# print(len(list1))
# with open('deprecated.json', 'r') as f:
#    list12= json.load(f)
# list1 = list(set(list1).difference(set(list12)))
# print(len(list1))
# exit()
###

# result = closest_match(list1, list2)

# for pair in result:
#     print(f"{pair[0]} -> {pair[1]}")

print(len(list1), len(list2))

paired_urls, used_destination_urls = create_redirects(list1, list2)
remaining = list(set(list2).difference(set(used_destination_urls)))
print(remaining)

print(len(list1), len(list2), len(paired_urls))

with open('remaining.json', 'w') as f:
   json.dump(remaining, f, indent=2)

with open('results-fw.json', 'w') as f:
   json.dump(paired_urls, f, indent=2)


csv_file_path = "matches.csv"
with open(csv_file_path, mode="w", newline="") as csv_file:
    # Create a CSV writer object
    csv_writer = csv.writer(csv_file)
    
    # Write the data from the JSON list of lists to the CSV file
    for row in paired_urls:
        csv_writer.writerow(row)

csv_file_path = "remaining.csv"
with open(csv_file_path, mode="w", newline="") as csv_file:
    # Create a CSV writer object
    csv_writer = csv.writer(csv_file)
    
    # Write the data from the JSON list of lists to the CSV file
    for row in remaining:
        row = [row,]
        csv_writer.writerow(row)

print(f"CSV file '{csv_file_path}' has been created.")

# Load the JSON data into a Pandas DataFrame
df = pd.DataFrame(paired_urls)#json_data[1:], columns=json_data[0])
df.sort_values(by=1, inplace = True)
df = df.reset_index(drop=True)

# Set display options to show all rows without truncation
pd.set_option('display.max_rows', None)

# Print the entire DataFrame
print(df)
