# San Francisco Fonts for Microsoft Office

__San Francisco Pro__ for iOS, macOS, and tvOS

__San Francisco Compact__ for watchOS 

__San Francisco Mono__ for Terminal and Code Editor 

---

This font is edited from [SFWin](https://github.com/blaisck/sfwin) by [blaisck](https://github.com/blaisck).

The fonts are edited with `ttx` from [`afdko`](https://github.com/adobe-type-tools/afdko).
TTF files are generated from OTF files with `otf2ttf` from [`fonttools`](https://github.com/fonttools/fonttools).

Items changed in the OpenType font files includes:
* `name` table (Platform ID=3, Name ID = 1&2)
* `OS/2.fsSelection` field
* `macStyle` field

These are changed to fit the family and link the Regular, Italic, Bold and Bold Italic variant together in Microsoft Office, making the press of **`B`** and *`i`* buttons in Microsoft Office working correctly.

SF Mono Italic is a special case as the original font has Name ID 2 `Regular Italic`. The changes are reflected to other font name (`name` table - Name ID 1, 2, 3, 4, 6, 17 for both Platform ID 1 and 3).

---

Be aware that this font is only for **personal use only** for cross-platform compatibility. I do not provide any promises or guarantee for the font generated and any legal confirmation or endorsement for the use of font on platforms other than Mac OS.

## DO NOT USE THIS FONT IN ANY COMMERCIAL SETTINGS ON NON-MAC OS SYSTEM. ALL RISK IS ON YOUR OWN.

---

Tested on _Windows 10 Pro 64-bit_. 
 
Open an issue if you have problem. 

Official site : [https://developer.apple.com/fonts](https://developer.apple.com/fonts/)

__NightFurySL2001__, source from __./blaisck__
