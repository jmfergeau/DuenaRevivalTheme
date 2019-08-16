#!/bin/sh

# REQUIRES SASS. Install with: 'npm install -g sass'

# Windows users, you can use this script if you install Git for Windows, using Git Bash.

echo Compiling sass scripts...
sass --source-map --style=compressed bootstrap-scss/bootstrap.scss ../bootstrap/css/bootstrap.min.css
sass --no-source-map --style=compressed style-scss/style.scss ../style.css

echo All done.
exit
