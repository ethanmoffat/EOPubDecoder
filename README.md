# EOPubDecoder
A PHP site that decodes and displays the Pub files for Endless Online

# General Information

This PHP site is designed to parse and display data from the Pub files from [Endless Online](http://www.endless-online.com). These files are copyrighted and as such are not distributed with this client. You can find more information on how to obtain these files [at this link](https://github.com/ethanmoffat/EndlessClient#CopyrightedFiles). 

You will need to launch the Endless Online client and log in. This will perform a fetch operation from the server - the PUB files can then be copied to the /pub/ directory of the repository.

This repository is not actively being maintained and was a side project I worked on during my second year at university. 

# Sample Hosted Site

A sample site is available [here](http://ewmoffat.ddns.net:8080/EOPubDecoder). This site uses the default Endless Online PUB files.

# Configuration

The configurable options are as follows:

`server_name` (string): The name of your server. This is used around the site for display purposes only.

`staff_name` (string array): A list of staff members for your server. This is used for display purposes only.

`use_cache` (boolean): True to use cache, false otherwise. Cached data is stored in the /cache/ folder and is much faster than re-parsing the PUB files each time the site is requested. Default is `TRUE`.

`items_per_page` (int): The number of search results that will be displayed per page when searching the PUB contents. Default is `15`.

The following options set ranged attributes for the gun item in default pubs and can be customized if a special item ID/name is used to replace the gun in custom pubs.

`_gun_item_name` (string): The name of the gun item. Default is "gun".

`_gun_item_id` (int): The item ID of the gun item. Default is 365.
