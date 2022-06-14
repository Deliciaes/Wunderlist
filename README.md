<img src="https://media0.giphy.com/media/2rKDe8JpAEatWVamEe/giphy.gif">

# Wunderlist

This is the final project of 2021 in the web development course at Yrgo (WU21). The aim is to create a website where a user can sign up, log in and create lists and tasks. The website is built using php, javascript and css.

# Requirements

The application should be written in HTML, CSS, JavaScript, SQL and PHP.

The application should be built using a SQLite database with at least three different tables.

The application should be pushed to a public repository on GitHub.

The application should be responsive and be built using the method mobile-first.

The application should be implement secure hashed passwords when signing up.

The project should implement an accessible graphical user interface.

The project should declare strict types in files containing only PHP code.

The project should not include any coding errors, warning or notices.

The project must be tested on at least two of your classmates computers. Add the testers name to the README.md file.

The project must receive a code review by another student. Add at least 10 comments to the student's README.md file through a pull request. Give feedback to the student below your name. The last student gives feedback to the first student in the list. Add your feedback one day before the presentation.

# Installation

Either visit the demo here: https://stickies.deliciaes.com/

Or download this repository and launch a localhost to run it locally on your machine.
# Code Review

Code review written by [DavisDavisDavis](https://github.com/DavisDavisDavis).

1. `update.php` - A lot of the '$statment->execute()' are repeated. Instead by using 'if' statements to check what 'post items' have been set, it is possible to only update the column that are in use ('isset'). E.g 

   'if (isset($_POST['title'])) {
      $statement->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    }'
    
2. `index.php:8` - Some issues with 'successMsg' It will give an error each time it's called. 📝

'Warning: Undefined variable $successMsg in /Users/macbook/Documents/GitHub/useless_website/Wunderlist-1/index.php on line 8
You are now logged out.'

3. `wunderlist.php` - A lot of divs could be replaces with html sematics or completely removed and combined into a single div; however I'm not familiar with bootstrap which might be the explanation for the amount of divs.

4. `wunderlistold.sqlite` - Just an old database. 📀🐱

5. `functions.js:5-9` - The functions that does't use 'return' could be set with the 'void' type declaration

6. `wunderlist.js` - All of the constants and comments at the beginning are a bit overwhelming 😵‍💫 and could either be split up into different files or the constants could be set above the respective functions that they will be used for. 

7. `account.php:64-65` - SVG could be saved in it's own file and saved in the images folder

8. `updateaccount.php:10-15` - As of now it is possible to upload pictures of any size as an avatar which probably should have a limit. 📸

9. `wunderlist` - All of the file names are in lowercase and for readability it would be better to use cammelCase or snake_case.

10. `wunderlist.php` - It is possible to get an error code inside of the task description... 

'Deprecated: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in /Users/macbook/Documents/GitHub/useless_website/Wunderlist-1/wunderlists.php on line 357'
# Testers

Tested by the following people:

1. Agnes Skönvall
2. Sofia Dersén
