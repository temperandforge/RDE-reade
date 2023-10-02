const puppeteer = require('puppeteer');

async function scrapeLinks(url, depth) {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  
  await page.goto(url);
  
  // Extract all links on the current page
  const links = await page.evaluate(() => {
    const anchors = Array.from(document.querySelectorAll('.uk-grid a'));
    return anchors.map(anchor => anchor.href);
  });
  
  // Print the links found on the current page
  // console.log( url );
//   console.log('Links on', url);
//   links.forEach(link => console.log(link));

  if(depth == 2) { return }
  
  // Follow the links and scrape them recursively
  for (const link of links) {
   if( ! link.includes('/products') ) { continue }
    await scrapeLinks(link, depth+1);
  }
  
  await browser.close();
}

// Start scraping from a specified URL
scrapeLinks('https://reade.com/products', 0); // Replace with the URL you want to start from
