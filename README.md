# instaConvoDecoder

Decode instgram messages from the instagram dump tool.

I made this tool since i couldn't find any official instagram decoder for their data dump.

##How to use:

1. Download your instagram data (https://help.instagram.com/181231772500920)
2. Download this tool and set it up in your PHP environment, and paste this tool in the htdocs (web folder)
3. Copy the "messages.json" file to the instaConvoDecoder which is in web folder.
4. Add your username to the "settings.json" file and you are good to go.

I also used this existing open source project(https://github.com/firmanjml/IGDM2Convo), of which i made improvements of my own.
--Added a feature to select the chats from the main page
--Changed code strucuture, made it easy to change settings using a JSON file (settings.json)
--Made the webApp responsive to mobile devices
--Design changes
