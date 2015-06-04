=== OptionTree Extension: Gravity Forms ===
Contributors: engelen
Donate link: http://www.jepps.nl
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: optiontree, gravityforms, options, option tree, gravity forms, gravity, tree, extension, addon, forms, form, option, gf, ot
Requires at least: 3.0
Tested up to: 3.8.1
Stable tag: 0.2.1

Adds Option Tree fields for linking Gravity Forms to Option Tree, allowing you to select a specific form for an option.

== Description ==

Integrate [Gravity Forms](http://www.gravityforms.com/) with [Option Tree](http://wordpress.org/extend/plugins/option-tree/), and add support for yourself or your customers to easily link to Gravity Forms from your Option Tree options panel.

= Forms field =
The plugin adds a field to the Option Tree field types list for linking to a form. Because Gravity Forms does not use custom post types for its forms, this is not possible with both plugins out of the box. Simply select the gravity forms field type in the Option Tree settings and allow your clients (and yourself) to link to a form from Gravity Forms like you link to a post or page.

= Translations =
For websites in another language than English, the plugin has translation files included for the following languages:
* Dutch

== Installation ==

1. Upload the folder `option-tree-gravityforms` to your plugins folder
1. Activate the plugin OptionTree Extension: Gravity Forms through the plugins panel in the admin panel.

That's all there is to it!

== Screenshots ==

1. Select the "Gravity Forms: Form" field type for a field to enable selecting a form for that field.
2. Selecting a form on the Theme Options page
3. The selected form on the Theme Options page

== Changelog ==

= 0.2.1 =
* [Updated] Tested up to WordPress version 3.8.1

= 0.2 =
* [Updated] Rewrite code
* [Updated] Localization changes
* [Fixed] Ensure the plugin checks whether Gravity Forms is active regardless of plugin loading priority

= 0.1 =
* Initial release