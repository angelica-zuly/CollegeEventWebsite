# CollegeEventWebsite

## General Project Information
This project is an implementation of a college event web application where there are 3 user levels. All users register with their university email to obtain login credentials (given as a user ID and a password). 

A “Super Admin” can create a profile for a university (given a name, location, description, and number of students), a “Student” can register their account once a Super Admin has created a profile for their university, and a Student can become an “Admin” if they create an organization (an RSO), and 5 or more other students join it. 

Thus, Admins own RSOs and may also host events. Events can be created with a name, event category, description, time, date, location, status (public, private, members-only), contact phone, and contact email address. In addition, events can be created without an RSO, but such events must be approved by the University’s Super Admin. 

Students who use the application can look up information about the various events, create new RSOs, or join an existing one. Users can filter events by selecting the University they want to see the events from, or by RSOs they are following. Furthermore, users can add, remove, and edit comments on published events.

### Project Demo Link: https://youtu.be/BrCoPlJrOpw

## Included Materials
1. ProjectReport.pdf - Full project description containing data models, sample data, features, results, observations and screenshots.
2. BuildInstructions.pdf - Documents the resources and steps needed inorder for the College Event Website to run.
3. college_events_db.sql - The sql database table file.
5. CollegeEvents - Folder that contains all the php source code.
