# Moviedatabase
This is an TYPO3 CMS Extension for showing your movie library in a nice way.

### Requirements
* `TYPO3 CMS Versions: 6.2.x - 7.6.x`
* `EXT: Bootstrap_Package 6.2.x - 7.6.x`
* `EXT: Extbase`
* `EXT: FLUID`

## List- View with Categories
![](https://raw.githubusercontent.com/dkoehl/pmmoviebase/master/Documentation.tmpl/Screenshots/Bildschirmfoto%202017-09-30%20um%2015.50.40.png)


## Single- View (Movie-Details)
Movie detail page, with metadata of the movie like original title, cast, trailer, popularity and the year of making.
![](https://raw.githubusercontent.com/dkoehl/pmmoviebase/master/Documentation.tmpl/Screenshots/Bildschirmfoto%202017-09-30%20um%2015.51.14.png)


## Scheduler Task 
This Scheduler Task is for getting Data from Movie APIs


![](https://raw.githubusercontent.com/dkoehl/pmmoviebase/master/Documentation.tmpl/Screenshots/Bildschirmfoto%202017-09-30%20um%2014.14.36.png)



### Installation
1. Download this extension to your extension directory.
2. Install the Static typoscript 
3. Insert the Plugin to your Pagecontent.
4. Add an Storagefolder for storing your movie data
5. Add Moviedata-Task to your scheduler management
6. Copy your Movie-Library File in the extension folder: `typo3conf/ext/pmmoviebase`
7. Add your Filename to the MovieScraper Task Script.
8. Add your API Keys to the MovieController and MovieScraper Task




### Frameworks or Third-Party Libraries
* Isotop (https://isotope.metafizzy.co)
* Bootstrap 3 (http://getbootstrap.com)
* jQuery / jQuery UI (https://jquery.com)
* jQuery Animsition (http://git.blivesta.com/animsition/)


### Used APIs 
* Movie Metadata from: themoviedb.org
* Images and Covers from : tmdb.org
* Trailers from: youtube.com
* Trailers from: trailersapi.com


### Notice
Your need to add your own API KEY to the Controller and Scheduler-Task

#### Contact
Twitter: @pmnewmedia 

