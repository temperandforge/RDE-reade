# READE ( WPEngine )



## TAGS
//POST
//TODO
//DEPLOY


## DEVELOPMENT


### Copying existing site / setting ip local copy
#### Using Local
Create a new site
In the `app` folder of the new site, rename the `public` to something else
Clone the repo as a sibling to the renamed folder and name it `public`: `git clone <URL> public`
Copy all files except the `wp-contents` folder from the renamed folder to the `public`
Start the site

# STARTER

In the Local App, `Trust` the ssl.
Do not interact with any notification bars Local gives you after entering you password.
Open `Keychain Access`, search for the new local domain and change to `Trust All`
Confirm with password

In your browser go the the https:// version of your domain directly.
Open the /admin 
Switch the theme
Enable the ACF plugins and any other to match the demo site setup
Make sure you are looking at the proxy version and not the localhost version of the backend - otherwise DB sync will replace the wrong URL
Enable WP DB Sync and go to the settings
On the demo version, enable 'accept pull request' and copy the unique value
Click on the pull option on the first tab on you local version
Paste the value from the demo site, leave the default setting otherwise and submit
This will replace the local login information with the login information from the demo site
Login again after the sync completes ( You can use the mailhog tool to reset passwor dif need be)


Open the theme in your code editor
run `npm i` // pnpm
FOR WINDOWS, COPY (dont rename) `.example.env.local` to `.env.local`
Change the WP_PROXY variable to match you local proxy
FOR WINDOWS, uncomment and update the HTTPS variables to your respetive certificates locations
Run `npm start`



#### New Site/Theme Setup
- wpengine_ed
- feat-twnd branch
- update package.json, actions, gitignores, style.css - starter



#### Common Troubleshooting
- Missing Dependecy - run `npm i` again then retry running `npm start`
- Missing assets shown on demo site - update REMOTE_URL to match the demo site


## TODO
- TEXTDOMAIN update, package, style.css
[THEME README](wp-content/themes/starter/README.md)


## Setup


#### After remote change
- update theme-develop - menus, pages, posts, cpts


## **CHANGELOG**




## **TODO**
- LAUNCH deploy branch- prd, stg, dev
- update workflows - txt
- xpostinstall
- litespeed cache htaccess was removed - https://github.com/jgansl/wpe-tf-starter/commit/09485420591a3f54671a78d1a6395c2a228e1884



## TAGS
- //TODO
- //STARTER
- //REFACTOR
- //PRE_LAUNCH

