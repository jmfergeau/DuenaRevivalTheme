# Duena Revival source files
This is where source files used for development are stocked. If you're installing Duena Revival in production, you can safely delete this `src` folder.

Here, you'll find the following:
- the `languages` folder: It contains additional unfinished languages fetched from [this archive](https://translate.wordpress.org/projects/wp-themes/duena) and updated for DuenaRevival. It also contains `DuenaRevival.pot`, which is a template to add new languages.
- the `style-scss` folder which contains the Sass that generates `style.css`, used by the theme.
- the `bootstrap` folder contains the scss of bootstrap for a faster update. To update, just put the contents of the bootstrap archive's `scss` folder into the `bootstrap` folder. Don't forget to update the js too!! (put `dist/js/bootstrap.bundle.min.js` and its map into the `js` folder in the theme root.)

If you use VSCode you can directly compile the Sass file using VSCode tasks.
