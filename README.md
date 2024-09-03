ASSIGNMENT (PHP) RESTFUL

Overview
This project is a full-stack PHP application that simulates user login and order checking functionalities. It demonstrates how to implement basic user authentication and view dynamic data through a fullstack project.
   - Frontend: boostrap, html, css
   - Middleware: php
   - Backend: firebase real-time database (NoSQL)

Notes:
  - Based on an early iteration of this project, I changed the database to allow for me to follow more RESTful principals. 
  - For example of use, I have included a json file that holds the same data and structure that is used in the firebase system.
  - Since the Firebase db has been set to read only from public use (and no PI), there is no need for passwords to access the database.
  - Since requirements only require login simulation, I have skipped hashing passwords and any auth keys normally needed. AT NO TIME is the password served to the front end. It is merely searched for in the db as a string.
  - Because the requirements for this assignment made data fetching very streight-forward to the user journey, there was no need for ajax as each data sets were only needed as the user went to a different page. Had their been more need for data to appear or be edited, an ajax system would have been necessary (thus why Javascript was lighter on this project).

Features
- User login from pre-created users.
- User-specific order viewing.

Requirements
- A local server environment such as MAMP or WAMP or XAMP. (I used a free version of MAMP here: https://www.mamp.info/en/mac/ )

Installation
- There are several ways you can install this project locally. I recommend downloading a zip file and opening the "public/index.php" file in your browser. In github, click on the "<> Code" button to see which option works best for you.
- If using a local sever, you will need to have that running while accessing the code library in your browser (e.g., http://localhost:xxxx/public/index.php).

Usage
1. Login:
  - Use the login page (login.php) to access your account with your credentials.
  - The demo user creds are provided here:
    - user: samwiseg pswd: p0t@ters!
    - user: gandalfw pswd: youshallnotp@ss!
    - user: demouser1 pswd: dem0us3r
2. View orders:
  - Once logged in, you will be directed to the home page or "Console" section of the project (index.php).
  - From here you can view orders assigned to your user (if any).
2. View order details:
  - Clicking on the order number of any particular displayed order (from index.php) will direct the user to the orders details page (order_details.php).
  - Here the user may see all items and their details assigned to the clicked order.

Folder Structure
public/ - Publicly accessible files (e.g., index.php, assets)
   index.php - the main landing page where user can view orders. Fetches orders and will redirect if there is no login session.
   login.php - handles login process such as validating credentials with db, startes a login session if the user is valid.
   logout.php - handles logout procedure; ends session, redirects user.
   nav_content.php - a section of code dedicated to reusable navigational content and then included in index.php & order_details.php
   order-details.php - displays the order items for the clicked order, redirects user if accessed incorrectly or without data.
src/ - PHP source code
   functions.php - the main fetch functions.
config/ - Configuration files.
   config.php - has a set constrant for the firebase url used in fetch functions.
project-data.json - an example file to display how data is contained in the firebase.
