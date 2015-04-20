# The WP Crowd
* Theme for www.thewpcrowd.com - a WordPress collective
  
# Build Instructions
* Clone Repo 
* run `npm install`
* run `gulp`
  
# Technologies
* WordPress (duh)
* Bootstrap
* SASS
* Gulp

# Notes
* Make global Bootstrap variable changes in `assets/scss/_bootstrap_custom_variables.scss` 
* Try to be modular create a new `_name.scss` file per page you work on, import into the `styles.scss` by doing `@import 'name.scss'`