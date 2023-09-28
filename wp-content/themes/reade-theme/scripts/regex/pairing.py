from urllib.parse import urlparse
import json, os, copy


def find_best_matching_subdomain(list1, list2):
    url_list1 = copy.copy(list1)  # Create a shallow copy of list1
    url_list2 = copy.copy(list2)  # Create a shallow copy of list2
    paired_urls = []#{}

    for url1 in url_list1:
        parsed_url1 = urlparse(url1)
        subdomain1 = parsed_url1.hostname.split('.')[0]

        best_match = None
        best_score = -1

        for url2 in url_list2:
            parsed_url2 = urlparse(url2)
            subdomain2 = parsed_url2.hostname.split('.')[0]

            # Calculate a simple score based on the length of the common prefix
            score = len(os.path.commonprefix([subdomain1, subdomain2]))

            if score > best_score:
                best_match = url2
                best_score = score

        if best_match is not None:
            # paired_urls[url1] = best_match
            paired_urls.append([url1, best_match])
            url_list2.remove(best_match)
        else:
            # paired_urls[url1] = 'None'
            paired_urls.append([url1, 'None'])

    # Handle unmatched items from url_list2
    for url2 in url_list2:
      #   paired_urls['None'] = url2
        paired_urls.append(['None', url2])

    return paired_urls

# Example usage:
with open('scott.json', 'r') as f:
   list2 = json.load(f)

with open('parse.json', 'r') as f:
   list1 = json.load(f)

print(len(list1), len(list2))

paired_urls = find_best_matching_subdomain(list1, list2)

print(len(list1), len(list2), len(paired_urls))

with open('result.json', 'w') as f:
   json.dump(paired_urls, f, indent=2)

# for url1, url2 in paired_urls.items():
#    print(f"{url1} => {url2}")
