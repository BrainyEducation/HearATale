# Hearatale

Hello, this documentation is for developers continuing work on the hearatale.com website. This doc was written by me (Kyle Xiao) based on my understanding of the codebase (so please direct any complaints at Cal). I'm writing this in order to hopefully mitigate some of the pains I had for the next dev on this project.

Hearatale.com is a project dedicated to distributing literature and viewable media to children and adults. Hearatale provides orally read content, such as fairy tales and nursery rhymes, in easily consumable video snippets, making stories easily accessible for teachers, students, and children.

## Getting Started

Hearatale is built in php, using the youtube player api for displaying media (previously this was via flowplayer, but changes were implemented to migrate media). 

### Organization

The video media in Hearatale is divided into several main sections: Children's Section, Students & Adults, and Southern Literature. There are other smaller features implemented as well, such as alphabet letters, as well as links to the literacy apps.

The Children's Section is further divided into several categories: rhymes, stories, older kids, world languages, etc. Within rhymes, there are Volland and Jerrold rhymes (where rhymes are read straight), and there are Mother Goose and Father Goose rhymes (which includes narration).

### Code Structure

Hearatale was originally made by <a href="https://github.com/calda">calda</a>. The functions of a few key files are as follows:

* category.php, subcategory.php - when browsing into a section, displays options (e.g. category has children's section > rhymes while subcategory has rhymes > Volland)
* children.php - displays menu for different options in children's stories
* function2.php - Connects to google spreadsheet database to load data about media, as well as other functions such as displaying messages
* index.php - Hosts home page 
* leftnav.php - Displays ads in left side
* video.php - Plays all the video files. Relies on GET variables "url" and "youtubeurl" to determine which videos are played.


### Database

The hearatale database is a google spreadsheet, which is linked in functions2.php. Contact Walter Evans for write access. The spreadsheet includes data that has where each video is located as well as it's youtube url. In addition, scripts were made to automatically update the database.

### Youtube
Hearatale videos are being moved to <a href="https://www.youtube.com/channel/UCD_hC6lVh0sVl45UU16HQbA/videos?sort=dd&shelf_id=0&view=0">this channel</a>. In addition, a script was made to automatically upload videos (see Walter for details).

## Deployment

Hearatale is deployed on <a href="https://sso.godaddy.com/?regionsite=www&app=account&realm=idp&plid=1&path=%2f&marketid=en-US">GoDaddy Web Hosting</a>. Contact Walter for sign in credentials. To access the web root, log in and go to "My Products" > "Manage" next to hearatale.com > "Manage Hosting" > "hearatale.com" > "cPanel Admin" > "File Explorer". You should then be able to modify files on the live site.

Alternatively, you can connect via an FTP client. Set the host as hearatale.com and set the user as ftp_website_backup@hearatale.com with the password the same as the one used to login to GoDaddy.

## Authors

* **Cal Stephens** - *Initial work* - [calda](https://github.com/calda)
* **Kyle Xiao** - *Maintenance + Migration* - [kylepxiao](https://github.com/kylepxiao)
* **Sam Billingham** - *Maintenance + Migration* - [sambillingham](https://github.com/sambillingham)

## License

This project is commissioned and licensed by Augusta University