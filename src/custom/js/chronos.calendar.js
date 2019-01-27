// JavaScript Document
/* ************************************************************************************************************************ *
*                                                                                                                           *
*      Filename: Chronos.Calendar.js                                                                                        *
*      Description: This is a custom chronos library containing functions for Chronos's calendar.                           *
*      Developer: Neelan Joachimpillai                                                                                      *
*      Dependancies: Knockoutjs                                                                                             *
*      Version control:                                                                                                     *
*                       Neelan Joachimpillai        Dec 25, 2012        Created file.                                       *
*                       Neelan Joachimpillai        Jan 05, 2012        Added function.                                     *
*                                                                                                                           *
*                                                                                                                           *
* ************************************************************************************************************************* */

// Will format the js date for the SQL and datepicker functions.
function standardMDYFormat(jsDate) {
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return months[parseDate(jsDate).getMonth()] + " " + parseDate(jsDate).getDate() + ", " + parseDate(jsDate).getFullYear();
}

function standardMDFormat(jsDate) {
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return months[parseDate(jsDate).getMonth()] + " " + parseDate(jsDate).getDate();
}

/* Functions below return numerics with regards to the date in the month */
// Returns the first date of the week.
function getWeekStart(jsDate) {
    var weekstart = parseDate(jsDate).getDate() - parseDate(jsDate).getDay(); // First day is the day of the month - the day of the week
    return weekstart;
}

// Gets last date of the week.
function getWeekEnd(jsDate) {
    return getWeekStart(jsDate) + 6;
}

/* Returns formatted date variables */
function getWeekEndMDY(jsDate) {
    var newDate = jsDate;
    var weekend = new Date(newDate.getFullYear(), newDate.getMonth(), getWeekEnd(newDate));
    return standardMDYFormat(weekend);
}

// Casting 
function parseDate(from) {
    //from = from.replace('T', '').replace(/-/g, '/');
    return new Date(from);
}