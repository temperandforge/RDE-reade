# [Public Health Post ( Boston University )](https://phpost.wpenginepowered.com)

## Developer Notes
- Pushing to `main` pushes to the development environment: https://seleledev.wpenginepowered.com/
- Pushing to `stg` pushes to the staging environment: https://selelestg.wpenginepowered.com/
- Pushing to `prd` pushes to the live site / production environment: https://selectelevated.wpenginepowered.com/

## Salesforce Integration Documenation


## Local Development Setup


## Syncing Changes
```
git stage .
git commit -m "<commit-message>"
git push
git checkout main
git merge <local_branch>
( :wq to escape vim confirmation )
git push (edited) 
```


## NEW SITE SETUP
- ignore plugins
- update README, style.css, package.json, TEXTDOMAIN
- change name of starter before init git
- remove starter from ! ignore
- setup branches + testing
- take screenshot from design


## NOTES
- need to unzip all zip folders in assets/fonts - issue with git on windows using GUI




## REMOTE
https://reade.wpengine.com
uuAZhAuHYoG61+z+rELDs04M5DeMlxgi


## Notes
- the mobile menu bottom padding to account for scrolling is set when the button is clicked. In development, preventing the menu hide on load will make this functionality not works as intended. It is not an issue. Simply it requires following the desired UX flow.
- change the menu requires selector updates in the scss - search `.menu-item-`


## CHANGELOG

#### 23-12-21:
- changed legal page to account expect iubenda raw embed HTML
- added special logic to account for terms of service of sales page which depends on this legal page








## !! DEPRECATE



# Resources
[LIVE](https://reade.com) - push from `prd`

[WPE Staging Environment ( FREE )](https://readestg.wpengine.com) - push from `stg`

[WPE Development Environment ( FREE )](https://readedev.wpengine.com)  - push from `main`



## Notes
- back link on /sustainable-products is static
- product sort is hard coded as each need internal ajax sorting functionality setup


## CHANGELOG
[2024.04.29]
