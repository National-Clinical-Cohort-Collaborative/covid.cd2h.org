# Body node ID class

Body node ID class module is used to add node ID (nid) and node type as a class to ```<body>``` tag on node pages.
In Drupal 7 core there was a unique node ID class in the ```<body>``` tag. 
This is forward-port of that functionality for Drupal 8.

## Installation
Install as you would normally install a contributed Drupal module.

### Configuration
This module works out of the box, once you enable it there is no need to configure anything, except clear your caches.
Node ID will show up in ```<body>``` tag as ```"page-node-{nid}"``` and Node Type will show up as 
```"page-node-type-{bundle}"``` which is equivalent to Drupal 7 core functionality.

### Usage
This module is useful for cases when specific pages need custom styling.
Target page using unique node ID as following CSS class (replace 123 with targeted node ID):

```.page-node-123{ }```
