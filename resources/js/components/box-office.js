/*
** Load the box office
*/

function bookSelectedScreening(e) {
 if(e.target.href.startsWith('https://tickets.hydeparkpicturehouse.co.uk/')) {
   e.preventDefault();
   console.log('spectrix!');
 }
};