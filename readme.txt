=== Embed Twine ===
Contributors: rluks
Tags: twine, twine 2, embed, embedding, insert, iframe
Requires at least: 5.3
Tested up to: 6.2
Stable tag: trunk
Requires PHP: 7.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Insert Twine stories into WordPress

== Description ==

Embed Twine makes it easy to insert Twine 2 stories into WordPress pages and posts.

1. Export story from Twine
1. Upload it
1. Copy shortcode
1. Paste shortcode on a page

Furthermore, it provides autoscroll functionality making it easy for users to navigate through your stories.

Plugin is configurable via shortcode parameters.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= I installed the plugin, where is it? =

Navigate to your Dashboard screen. In the menu, select "Tools" and "Embed Twine".

= How do I use the shortcode? =

Simply put the shortcode text in your page or post. Modern Gutenberg (block editor) provides "Shortcode widget". You can use either. 

You can use aditional parameters: "[embed_twine story="Story" aheight=112 autoscroll=true ascroll=100]"

**story**
Specify the story (filename without extension). When story parameter is omitted, it defaults to "Story". Meaning, there is no need to use this parameter if your Twine filename is Story.html.
If you upload Twine story file MyFooBar.html use following the shortcode [embed_twine story="MyFooBar"].

**aheight**
Use it to adjust iframe height. You might need to tweak this parameter to get rid of iframe scrollbar. Default value is 112. This value is added to iframe height and used to set iframe's style.height.

**autoscroll**
Autoscroll is enabled by default. Turn it off with shortcode parameter [embed_twine autoscroll=false].

**ascroll**
Use it to adjust default position for autoscroll. Default value is 100. This value is subtracted from detected iframe top position and fed into javascript method window.scrollTo().

= What's Twine? =

 Twine is open source tool for creating interactive stories.

= Does this plugin support stories created in Twine 1? =

No, this plugin only supports Twine 2 stories.

= Which Twine 2 story formats are supported? =

I've tested following formats:
* Harlowe 1.2.4
* SugarCube 2.30.0

== Screenshots ==

1. Twine iframe height is automatically adjusted (short passage).
2. Twine iframe height is automatically adjusted (long passage).
3. Embed Twine plugin interface.
4. Upload your Twine story and copy the shortcode.
5. Insert shortcode on a page or post.

== Changelog ==

= 0.1.0 =
* Improved UI/UX

= 0.0.9 =
* Improved UI/UX

= 0.0.8 =
* Improved UI/UX

= 0.0.7 =
* Improved UI/UX

= 0.0.6 =
* Preserve PassageFooter if it already exists

= 0.0.5 =
* Processed stories are now stored in embed-twine subfolder in the uploads directory to persist during plugin updates

= 0.0.4 =
* Added support for SugarCube 2.30.0.

= 0.0.3 =
* Plugin needs to create public folder with proper permissions.
* Removed old debug code.

= 0.0.2 =
* Require PHP 7.3.

= 0.0.1 =
* Initial version.

== Upgrade Notice ==

= 0.0.5 =
Location for storing processed stories was changed to persist during plugin updates.
Reupload original stories via plugin interface.

= 0.0.1 =
Initial version, no upgrade.

== Known bugs ==
Currently, Twine passages which include images might report their height incorrectly. Scrollbar might show up for these passages. Tweak shortcode parameter aheight to get rid of them.
