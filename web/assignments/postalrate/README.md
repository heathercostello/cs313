# Postal Rate Calculator
This is the prove assignment for week 9 in CS313. It provides a simple application to calculate First Class postal rates given a weight and type of post.

## To Use
 * Enter the weight; the value must be greater than 0 and can be specified to two decimal places
 * Choose the type of mail from the drop-down
 * Click the button
 
## To Use with AJAX
By default, the application uses a postback to the server. However, it can use AJAX instead by flipping the toggle at the bottom of the calculator to "AJAX". You can revert it to the default method by switching the toggle back to "Old-school".

Some benefits of the AJAX method:
 * Faster (though it may be hard to discern)
 * Settings are retained
   * When you go to either the result or error page and come back, the settings you entered into the form are still there
 
## Server
The server uses NodeJS, Express, and EJS.

## Client
The client uses React and React Router (when in AJAX mode) as well as Styled Components (to create the toggle switch at the bottom of the calculator).

## Appearance
The application uses the Flatly style from [Bootswatch](https://bootswatch.com/).
