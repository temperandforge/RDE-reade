import requests
from bs4 import BeautifulSoup
from urllib.parse import urlparse, urljoin

def find_subpaths(url):
    response = requests.get(url)
    if response.status_code == 200:
        soup = BeautifulSoup(response.text, 'html.parser')
        base_url = urlparse(url).scheme + '://' + urlparse(url).netloc

        subpaths = set()
        for a_tag in soup.find_all('a', href=True):
            href = a_tag['href']
            absolute_url = urljoin(base_url, href)
            subpaths.add(absolute_url)

        return subpaths
    else:
        print(f"Failed to retrieve the page: {url}")
        return set()

url = 'https://reade.com'  # Replace with your desired URL
subpaths = find_subpaths(url)
for subpath in subpaths:
    print(subpath)
