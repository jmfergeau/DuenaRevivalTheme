# DuenaRevival language packs
These files are .po (and sometimes .mo) files used for translation.
The files are from [this archive](https://translate.wordpress.org/projects/wp-themes/duena) and updated for DuenaRevival.

## Translate
To translate, I suggest you use POEditor since all the `.po` files were converted for it.

If your language has already a `.po` file, do as follows:
- Fork the whole repository and clone it in local
- Open the `.po` file with POEditor
- Click on the `Code update` button to be sure all the translatable strings are here
- Translate the missing lines, correct the others if needed, etc...
- Save your work and compile the `.mo` file from the `.po`
- Push all of this in your forked repo and make a merge request ;)

If your language is not available, do as follows:
- Fork the whole repository and clone it in local
- Open the `DuenaRevival.pot` file with POEditor
- Click on the `Code update` button to be sure all the translatable strings are here
- Save the file as `xx_XX.po`, xx_XX being the region code of the language.
- Translate the missing lines, correct the others if needed, etc...
- Save your work and compile the `.mo` file from the `.po`
- Push all of this in your forked repo and make a merge request ;)

## Install
When you install the theme in your wordpress, feel free to only keep the language(s) you're interested, as long as you:
- keep `en_EN.mo` and `en_EN.po` for the missing strings
- compile the `.mo` file of your language if it's missing in the repository (using POEditor for instance)

Know that most of the languages are not 100% translated yet.
