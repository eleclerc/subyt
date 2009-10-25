SubYT
=====

SubYT is a niche video website engine for West Coast Swing Video.
 
It's current purpose is to be a testing bed for GitHub, Zend Framework and Google Data API.

Requirements
------------

Create a `library` folder and put these libraries in it (or have them in your php include path)

- [Zend Framewok](http://framework.zend.com) v1.9.x
- [ZFDebug Bar](http://code.google.com/p/zfdebug/) v1.5.x

Create a database and load the data

    cd application/data
    sqlite3 subyt_development.sqlite
    sqlite> .read schema.sql
    sqlite> .read sample-data.sql
    
Configure your Apache web server to serve the `public` folder as the DocumentRoot