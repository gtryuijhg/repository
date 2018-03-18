'use strict';

var dayNames;
var monthNames;
var today;

dayNames   = new Array();
monthNames = new Array();


dayNames[0] = 'Dimanche';
dayNames[1] = 'Lundi';
dayNames[2] = 'Mardi';
dayNames[3] = 'Mercredi';
dayNames[4] = 'Jeudi';
dayNames[5] = 'Vendredi';
dayNames[6] = 'Samedi';


monthNames[0]  = 'Janvier';
monthNames[1]  = 'Février';
monthNames[2]  = 'Mars';
monthNames[3]  = 'Avril';
monthNames[4]  = 'Mai';
monthNames[5]  = 'Juin';
monthNames[6]  = 'Juillet';
monthNames[7]  = 'Août';
monthNames[8]  = 'Septembre';
monthNames[9]  = 'Octobre';
monthNames[10] = 'Novembre';
monthNames[11] = 'Décembre';


today = new Date();

document.write('Aujourd\'hui nous sommes le ' + dayNames[today.getDay()] + ' ');
document.write(today.getDate() + ' ');
document.write(monthNames[today.getMonth()] + ' ');
document.write(today.getFullYear() + '.');