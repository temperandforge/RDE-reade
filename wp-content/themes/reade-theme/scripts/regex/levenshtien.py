import Levenshtein, json, os

# def closest_match(source_list, target_list):
#     zipped_pairs = []
#     target_list_copy = target_list.copy()  # Create a copy of the target list

#     for source_url in source_list:
#         best_match = None
#         best_distance = float('inf')

#         for target_url in target_list_copy:
#             source_path = source_url.split("/")[-1]
#             target_path = target_url.split("/")[-1]

#             distance = Levenshtein.distance(source_path, target_path)

#             if distance < best_distance:
#                 best_match = target_url
#                 best_distance = distance

#         if best_match:
#             zipped_pairs.append((source_url, best_match))
#             target_list_copy.remove(best_match)  # Remove from the copy, not the original

#     return zipped_pairs

def closest_match(source_list, target_list):
    zipped_pairs = []

    for source_url in source_list:
        best_match = None
        best_distance = float('inf')

        for target_url in target_list:
            source_path = source_url.split("/")[-1]
            target_path = target_url.split("/")[-1]

            distance = Levenshtein.distance(source_path, target_path)

            if distance < best_distance:
                best_match = target_url
                best_distance = distance

        zipped_pairs.append((source_url, best_match))

    return zipped_pairs


def find_best_match(source_url, destination_urls):
    best_match = None
    best_distance = float('inf')

    for dest_url in destination_urls:
        source_path = source_url.split("/")[-1]
        dest_path = dest_url.split("/")[-1]

        distance = Levenshtein.distance(source_path, dest_path)

        if distance < best_distance:
            best_match = dest_url
            best_distance = distance

    return best_match if best_distance <= 2 * len(source_path) else None

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

    return redirects

# Example usage:
source_urls = [
    "https://example.com/product123",
    "https://example.com/page456",
    "https://example.com/item789"
]

target_urls = [
    "https://example.com/productABC",
    "https://example.com/pageXYZ",
    "https://example.com/item123"
]

with open('scott.json', 'r') as f:
   list2 = json.load(f)

with open('parse.json', 'r') as f:
   list1 = json.load(f)

# result = closest_match(list1, list2)

# for pair in result:
#     print(f"{pair[0]} -> {pair[1]}")

print(len(list1), len(list2))

paired_urls = create_redirects(list1, list2)

print(len(list1), len(list2), len(paired_urls))

with open('results.json', 'w') as f:
   json.dump(paired_urls, f, indent=2)
