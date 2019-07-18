# Zoomify

Zoomify page that works with any image.

| Parameter | Description                                                                                       |
| --------- | ------------------------------------------------------------------------------------------------- |
| `src`     | The URL of the image to zoomify.                                                                  |
| `caption` | Caption text to display underneath the image and metadata.                                        |
| `return`  | When provided a URL is provided a button will be shown allowing the user to go back to that path. |

The `index.php` script loads the required zoomify libraries, embeds JSON-LD metadata of the type https://schema.org/ImageObject, and creates thumbnails of the image to be used as favicon and social media tags.


---
The original `zoomify.js` and `zoomify.css` files, and the zoom-in/zoom-out images have been created by Craig Francis and are subject to the following license:

Copyright (c) 2012, Craig Francis All rights reserved.

Redistribution and use in source and binary forms,
with or without modification, are permitted provided
that the following conditions are met:

 * Redistributions of source code must retain the
   above copyright notice, this list of
   conditions and the following disclaimer.
 * Redistributions in binary form must reproduce
   the above copyright notice, this list of
   conditions and the following disclaimer in the
   documentation and/or other materials provided
   with the distribution.
 * Neither the name of the author nor the names
   of its contributors may be used to endorse or
   promote products derived from this software
   without specific prior written permission.

This software is provided by the copyright holders
and contributors "as is" and any express or implied
warranties, including, but not limited to, the
implied warranties of merchantability and fitness
for a particular purpose are disclaimed. In no event
shall the copyright owner or contributors be liable
for any direct, indirect, incidental, special,
exemplary, or consequential damages (including, but
not limited to, procurement of substitute goods or
services; loss of use, data, or profits; or business
interruption) however caused and on any theory of
liability, whether in contract, strict liability, or
tort (including negligence or otherwise) arising in
any way out of the use of this software, even if
advised of the possibility of such damage.
