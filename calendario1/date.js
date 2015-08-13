/*
Script by RoBorg
RoBorg@geniusbug.com
http://javascript.geniusbug.com | http://www.roborg.co.uk
Please do not remove or edit this message
Please link to this website if you use this script!
*/

function getFormattedDate(format, dateObj)
{
	var val = new Array();

	if(dateObj.getHours() < 12) val['a'] = 'am';
	else val['a'] = 'pm';
	val['A'] = val['a'].toUpperCase();

	val['j'] = dateObj.getDate();
	val['d'] = padZero(val['j']);


	var day = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	val['w'] = dateObj.getDay();
	val['l'] = day[val['w']];
	val['D'] = val['l'].substring(0, 3);

	var month = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	val['F'] = month[dateObj.getMonth()];
	val['M'] = val['F'].substring(0, 3);

	val['G'] = dateObj.getHours();
	val['H'] = padZero(val['G']);

	val['g'] = val['G'];
	if(val['g'] > 12) val['g'] -= 12;
	val['h'] = padZero(val['g']);

	val['i'] = padZero(dateObj.getMinutes());


	if(dateObj.getFullYear()%4 == 0) val['L'] = 1;
	else val['L'] = 0;
	if((dateObj.getFullYear()%100 == 0) && (dateObj.getFullYear()%400 != 0)) val['L'] = 0; //Thanks to Tim for pointing this out

	val['n'] = dateObj.getMonth() + 1;
	val['m'] = padZero(val['n']);

	val['s'] = padZero(dateObj.getSeconds());

	var dateDigit2 = val['d'].toString().substring(val['d'].toString().length-1, 2);
	val['S'] = 'th';
	
	switch(dateDigit2)
	{
		case '1': val['S'] = 'st'; break;
		case '2': val['S'] = 'nd'; break;
		case '3': val['S'] = 'rd'; break;
	}
	if((val['j'] >= 11) && (val['j'] <= 13))
	val['S'] = 'th';


	var daysInMonth = new Array(31, 31, 28 + val['L'], 31, 30, 31, 30, 31, 31, 30, 31, 30)
	val['t'] = daysInMonth[dateObj.getMonth()];

	val['T'] = dateObj.toString().split(" ")[4].substring(0, 3);

	val['U'] = parseInt(dateObj.getTime() / 1000);

	val['Y'] = dateObj.getFullYear();
	val['y'] = val['Y'].toString().substring(1, 3);


	var dayNums = new Array();
	dayNums[0] = 0;
	var totalDays = 0;
	for(var x=1; x<=12; x++)
	{
		dayNums[x] = totalDays + daysInMonth[x-1];
		totalDays += daysInMonth[x-1];
	}
	val['z'] = dayNums[dateObj.getMonth()] + dateObj.getDate() - 1;

	val['Z'] = dateObj.getTimezoneOffset() * 60;
	
	val['r'] = val['D'] + ', ' + val['j'] + ' ' + val['M'] + ' ' + val['Y'] + ' ' + val['H'] + ':' + val['i'] + ':' + val['s'];
	var offset = val['Z']/3600;
	if(offset < 1) offset = ' -' + padZero(Math.abs(offset)) + '00';
	else offset = ' +' + padZero(Math.abs(offset)) + '00';
	if(offset != '+0000') val['r'] += offset;


	var newStr = '';
	for(var x=0; x<format.length; x++)
	{
		if(typeof(val[format.charAt(x)]) != 'undefined') newStr += val[format.charAt(x)];
		else newStr += format.charAt(x);
	}

	return newStr;
}



function padZero(value)
{
	if(value < 10) return '0' + value;
	return value;
}

