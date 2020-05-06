Readme:
 Requirements for deployment:
 1. PHP 7.0 and above
 2. Apache Web server(or any other of your choice)
 3. MySQL Database. 

Installation:
 1. Create and setup MySQL database.
 2. Import the cafeteria.sql script in your MySQL database.
 3. Configure the environmental variables in .env file (This includes setting up MySQL variable needed for the project)
 4. Add virtual host to your httpd.conf(or httpd-vhosts.conf) file in your Apache Web Server installation directory: 
 
      <VirtualHost *:80>
            ServerName (*localhost is set by default but welcome to pick any*.)
            DocumentRoot "(*Directory in which COS application is*)/COS/public"
            <Directory  "(*Directory in which COS application is*)/COS/">
                Options +Indexes +Includes +FollowSymLinks +MultiViews
                AllowOverride All
                Require local
            </Directory>
       </VirtualHost>
  5. Configure the .env file.    
  6. Access COS app using URL - http://yourhostname:80/ .

 Requirements for Web Access:
  1. Javascript enabled browser.
  2. CSS-enabled browser.
  
 User login info:
	
    Menu Manager: 
		1. Email: test@gmail.com
		   Password: password
		
	Patron:
        1. Email: is314lcnotif@gmail.com
		   Password: password	
		2. Email: cs324assignment@gmail.com
		   Password: password
		3. Email: mishra@gmail.com
           Password: password        
    
    Cafeteria Staff:
        1. Email: cafeteria@gmail.com
           Password: password
    
    Deliverer:
        1. Email: deliverer@gmail.com
           Password: password
