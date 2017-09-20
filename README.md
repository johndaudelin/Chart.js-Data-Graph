# Chart.js Data Graph

## Description

This was a submission for the RDE Fall 2016 coding contest. The challenge (quoted from their website [here](http://www.rde.org/codingchallenge/index.cfm?archive=2016fall)) was to "write a small web app that retrieves data from an SQL database and creates a graph from it. Use an HTML5 / JS chart library for client-side chart rendering."

The data that I plot (included here as "data.csv") is approximately 11,000 entries of page load speeds for a certain web page with corresponding time stamps for when the web page was accessed. All the data is for the month of July. My application averages the load speeds for each day in July and graphs these averages, interpolating over days where no load speed was recorded.

## Demo

I hosted my app [here](http://treksoftware.org/Fall2010/RDEChallenge/) for viewing, but you can also follow the steps below to setup the web app on a locally hosted server.

## Setup

Download Xampp from [here](https://www.apachefriends.org/download.html) and begin running Apache and MySQL from the Xampp control panel. 

Copy the entire “src” folder in this repository into the directory .../xampp/htdocs/ (depending on where you installed Xampp). 

### Creating and intializing the database

Open phpMyAdmin (from the Xampp control panel) and create a new database called “pageloads.” 

Download the “data.csv” file from this repository and copy it into the directory .../xampp/mysql/data/pageloads/.

In phpMyAdmin, run these queries on your newly created database “pageloads:"

```
CREATE TABLE LoadSpeeds(
	LoadTime int,
	TimeLoaded varchar(30)
);

LOAD DATA INFILE 'data.csv' 
INTO TABLE LoadSpeeds 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\r\n'
IGNORE 1 LINES;
```

### Running the web app

Open Google Chrome and enter this URL: “localhost/src”. The graph should be displayed.

## Code

I created an API (getData.php) which simply retrieves all rows of data from the "LoadSpeeds" database table and returns them in JSON format using four simple lines of code:

```
$con = mysqli_connect("localhost", "root", "", "pageloads");
	
$result = mysqli_query($con,"SELECT * FROM LoadSpeeds");

$data = $result->fetch_all( MYSQLI_ASSOC ); 

echo json_encode( $data );
```

Inside index.html, I use jQuery to make an AJAX request to this API. Then I plot the graph after doing some simple manipulations of the data and using Chart.js for client-side visualization.

## History

Began work on 10/5/2016.

Finished development on 10/13/2016.

## Authors

John Daudelin