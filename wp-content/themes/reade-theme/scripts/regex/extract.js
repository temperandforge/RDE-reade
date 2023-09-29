const axios = require('axios');
const cheerio = require('cheerio');
const { URL } = require('url');

async function findSubpaths(url, targetSubpath) {
  try {
    const response = await axios.get(url);
    if (response.status === 200) {
      const $ = cheerio.load(response.data);
      const baseUrl = new URL(url).origin;

      const subpaths = new Set();
      $('a').each((index, element) => {
        const href = $(element).attr('href');
        if (href) {
          const absoluteUrl = new URL(href, baseUrl).toString();
          subpaths.add(absoluteUrl);
        }
      });

      console.log(`Subpaths found on ${url}:`);
      subpaths.forEach(subpath => console.log(subpath));

      if (targetSubpath) {
        console.log(`Checking for '/${targetSubpath}' in subpaths...`);
        const matchingSubpaths = Array.from(subpaths).filter(subpath =>
          subpath.includes(`/${targetSubpath}`)
        );

        if (matchingSubpaths.length > 0) {
          console.log(`Subpaths containing '/${targetSubpath}':`);
          matchingSubpaths.forEach(subpath => findSubpaths(subpath, targetSubpath));
        } else {
          console.log(`No subpaths containing '/${targetSubpath}' found.`);
        }
      }
    } else {
      console.log(`Failed to retrieve the page: ${url}`);
    }
  } catch (error) {
    console.error(`Error: ${error.message}`);
  }
}

const initialUrl = 'https://reade.com/products';
const targetSubpath = 'products';
findSubpaths(initialUrl, targetSubpath);
