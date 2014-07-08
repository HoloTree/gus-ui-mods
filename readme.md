### Instructions

The main class of your plugin will extend holotree\addon\addon_base. When initializing that class there are five required arguments: $info, $css, $js, $hooks, $args

* $info - An array of information about your add-on.


@TOD Document details on that.

* $css - An array of CSS files to load, in the form of slug => file name.

* $js - An array of JS files to load, in the form of slug => file name.

* $hooks - An array of hooks to add.

* $args - Doesn't do anything yet. Leave null.

@TODO Document using the included functions to do ^^

### Rename
<em>These apply to all files. Finding and replacing in path, if your IDE supports it is recommended.</em>
1. Rename files

1. 'Holotree Starter Plugin' to the name of your add-on Plugin as it will be displayed publicly.

1. 'http://add-on-site.com/' to the URL for this add-on plugin.

1. 'Your Name' to your name.

1. 'http://your-site.com/' to the URL for your website.

1. 'holotree-addon-starter' to the slug for this plugin. Should be same as the main file and main directory. Will be used as text-domain.

1. 'YEAR' with the current year.

1. 'Your Email' With your email address

1. 'HOLOTREE_EXTEND' With your all caps slug. Used mainly for constants.

1. 'holotree_addon_starter' With your plugin slug using underscores instead of dashes. Used for function names, as well as the name of the main class so must be valid for that use. Can not start with a number or have dashes.

