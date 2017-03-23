=== CFS - Contact Form 7 Field ===
Contributors: felipeelia
Donate link: http://felipeelia.com.br/
Tags: cfs, Custom Field Suite, Contact Form 7, cf7
Requires at least: 4.0
Tested up to: 4.6.1
Stable tag: 1.1
License: GPLv2

Contact Form 7 field for Custom Field Suite

== Description ==

Creates a new type of field into <a href="https://wordpress.org/plugins/custom-field-suite/">Custom Field Suite</a>: the user can select any form generated with <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a>.

You can get the form HTMLed using <code>CFS()->get( 'form_field_id' )</code> or the form ID using <code>CFS()->get( 'form_field_id', get_the_ID(), array( 'format' => 'raw' ) )</code>.

Note: Obviously, this plugin requires both "Custom Field Suite" and "Contact Form 7" to work.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/cfs-cf7` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Enjoy

== Frequently Asked Questions ==

= Can I choose HTML class or id of the form? =

Yes. You can enter those values at Fields Group edit screen :)

== Screenshots ==

1. Creating the field
2. Using it

== Changelog ==

= 1.1 (2016-12-06) =
* Main class now extends cfs_field
= 1.0 (2016-10-06) =
* First Relase