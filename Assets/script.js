/**
 *
 * Helper Functions for adding and removing classes
 *
 */

var removeClass = function (element, classToRemove) {
	element.className = element.className.split(" ").map(function (currentClass, index, arr) {
		if (currentClass !== classToRemove) {
			return currentClass;
		}
	}).join(" ").replace(/ {2,}/g, "");
};

var removeClassAll = function (elList, classToRemove) {
	for (var i = 0; i < elList.length; i++) {
		removeClass(elList[i], classToRemove);
	}
};

var addClass = function (element, classToAdd) {
	// just in case the class is already there, remove it
	removeClass(element, classToAdd);
	element.className += " " + classToAdd;
};

var hasClass = function (element, compareClass) {
	return element.className.replace(compareClass, "").length !== element.className.length;
};

var hasParentWithClass = function (el, compareClass) {
	var result = false;

	if (hasClass(el, compareClass)) {
		result = true;
	} else {
		while (el.parentElement) {
			el = el.parentElement;

			if (hasClass(el, compareClass)) {
				result = true;
				break;
			}

		}
	}

	return result;
};

var hasParentWithID = function (el, compareID) {
	var result = false;

	if (el.id && el.id === compareID) {
		result = true;
	} else {
		while (el.parentElement) {
			el = el.parentElement;

			if (el.id && el.id === compareID) {
				result = true;
				break;
			}

		}
	}

	return result;
};

/**
 *
 * Responsive Grid Generator
 *
 **/

/*
(function () {

 	var cssString= "";

	var breakpoints = {
		small: {
			size: 480,
			cols: [6]
		},
		medium: {
			size: 768,
			cols: [3, 4, 6, 12]
		},
		large: {
			size: 992,
			cols: [2, 4, 5, 6, 8]
		},
		xlarge: {
			size: 1200,
			cols: [2, 3, 4, 5]
		}
	}

 	var columns = 12;
 	var gutter = 20;

	cssString += [
		".gs {",
			"\tmargin-left: -" + gutter + "px;",
			"\tmargin-right: -" + gutter + "px;",
		"}\n",
		".gs-col {",
			"\tfloat: left;",
			"\tpadding-left: " + gutter + "px;",
			"\tpadding-right: " + gutter + "px;",
		"}\n\n"
	].join("\n");


	// the default sizing
	for (var i = 1; i <= columns; i++) {
		cssString += ".gs" + i + " {\n\t\twidth: " + Math.round(((100 / columns) * i) * 100000) / 100000 + "%\n\t}\n\n";
		cssString += ".gs" + i + "-before {\n\t\tmargin-left: " + Math.round(((100 / columns) * i) * 100000) / 100000 + "%\n\t}\n\n";
		cssString += ".gs" + i + "-after {\n\t\tmargin-right: " + Math.round(((100 / columns) * i) * 100000) / 100000 + "%\n\t}\n\n";
	}

	for (breakpoint in breakpoints) {
		cssString += "@media screen and (min-width: " + breakpoints[breakpoint].size + "px) {\n\n";

		for (var i = 0; i < breakpoints[breakpoint].cols.length; i++) {

			cssString += "\t.gs-" + breakpoint + breakpoints[breakpoint].cols[i] + " {\n\t\twidth: " + Math.round(((100 / columns) * breakpoints[breakpoint].cols[i]) * 100000) / 100000 + "%\n\t}\n\n";
			cssString += "\t.gs-" + breakpoint + breakpoints[breakpoint].cols[i] + "-before {\n\t\tmargin-left: " + Math.round(((100 / columns) * breakpoints[breakpoint].cols[i]) * 100000) / 100000 + "%\n\t}\n\n";
			cssString += "\t.gs-" + breakpoint + breakpoints[breakpoint].cols[i] + "-after {\n\t\tmargin-right: " + Math.round(((100 / columns) * breakpoints[breakpoint].cols[i]) * 100000) / 100000 + "%\n\t}\n\n";

		}

		cssString += "}\n\n";

	}

 	console.log(cssString);

})();
*/

/**
 *
 * Calendar Widget
 * Generates a calendar
 *
 *
 **/

var calendarPlugin = (function () {
	var days = ["Sunday" ,"Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	// is there a way to do this in using the Date object?
	var numDaysInMonths = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
	var ONE_DAY = 24 * 60 * 60 * 1000;
	var timeStampCache = {};


	var isLeapYear = function (year) {
		return ((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0);
	};

	var getPrevMonth= function (monthNum, yearNum) {
		if (monthNum - 1 < 0) {
			return 11;
		} else {
			return --monthNum;
		}
	};

	var getYearOfPrevMonth = function (monthNum, yearNum) {
		if (monthNum - 1 < 0) {
			return --yearNum;
		} else {
			return yearNum;
		}
	};

	var getNextMonth = function (monthNum, yearNum) {
		if (monthNum + 1 > 11) {
			return  0;
		} else {
			return ++monthNum;
		}
	};

	var getYearOfNextMonth = function (monthNum, yearNum) {
		if (monthNum + 1 > 11) {
			return ++yearNum;
		} else {
			return yearNum;
		}
	};

	var getNumDaysInMonth = function (monthNum, yearNum) {
		if (monthNum === 1 && isLeapYear(yearNum)) {
			return 29;
		} else {
			return numDaysInMonths[monthNum];
		}
	};

	var getNumDaysInPrevMonth = function (monthNum, yearNum) {
		if (monthNum === 0) {
			monthNum = 11;
			yearNum--;
		}
		return getNumDaysInMonth(monthNum, yearNum);
	};

	var Plugin = function (settings) {

		if (!settings.date) {
			settings.date = new Date();
		}

		this.monthNum = settings.date.getMonth();
		this.yearNum = settings.date.getFullYear();
		this.daysInMonth = getNumDaysInMonth(this.monthNum, this.yearNum);

		this.todayStart = new Date().setHours(0,0,0,0);
		this.todayEnd = new Date().setHours(23,59,59,999);

		this.el = settings.el;

		if (settings.disableBefore && settings.disableAfter && settings.disableBefore > settings.disableAfter) {
			throw "The 'disableBefore' after needs to be set to a time after 'disableBefore'";
		}  else {
			if (settings.disableBefore) {
				this.disableBefore = settings.disableBefore;
			}

			if (settings.disableAfter) {
				this.disableAfter = settings.disableAfter;
			}
		}

		if (settings.onDateSelect) {
			this.onDateSelect = settings.onDateSelect;
		}

		this.dateRangeStart = 0;
		this.dateRangeEnd = 0;

		this.generateCalUI();

		this.el.addEventListener("click", this.onClickEvent.bind(this), false);
	};

	Plugin.prototype = {

		onClickEvent: function (e) {

			e.preventDefault();

			var dateStamp;

			if (e.target.nodeName === "BUTTON" && e.target.dataset.timestamp) {
				dateStamp =  parseInt(e.target.dataset.timestamp);

				if (this.onDateSelect) {
					this.onDateSelect(dateStamp);
				}

			}

		},

		generateCalUI: function () {
			var html = "";
			var dayOfMonth = (new Date(this.yearNum, this.monthNum)).getDay();
			var numDaysInPrevMonth = getNumDaysInPrevMonth(this.monthNum, this.yearNum);
			var dateTimeStamp;

			html += "<div class='cal'><table><thead><tr><th colspan='7'>" + months[this.monthNum] + " " + this.yearNum + "</th></tr><tr class='cal-days'>";

			for (i = 0; i < 7; i++) {
				html+= "<th>" + days[i].substring(0,3) + "</th>";
			}

			html += "</tr></thead><tbody><tr>";

			for (i = dayOfMonth; i > 0; i--) {
				html += "<td class='cal-prevMonth'>" + (numDaysInPrevMonth - (i - 1)) + "</td>";
			}

			for (i = 1; i <= this.daysInMonth; i++) {
				if (!timeStampCache[this.yearNum + "" + this.monthNum + "" + i]) {
					timeStampCache[this.yearNum + "" + this.monthNum + "" + i] = new Date(this.yearNum, this.monthNum, i).getTime();
				}

				dateTimeStamp = timeStampCache[this.yearNum + "" + this.monthNum + "" + i];

				if ((this.disableBefore && dateTimeStamp < this.disableBefore) || (this.disableAfter && dateTimeStamp > this.disableAfter)) {
					html += "<td class='" + (this.isToday(dateTimeStamp)? "cal-today":"") + " cal-disabled'><button data-timestamp='" + dateTimeStamp + "' disabled>" + i + "</button></td>";
				} else {
					html += "<td class='cal-currentMonth " + (this.dateRangeStart == dateTimeStamp? "cal-dateRangeStart": "") + (this.dateRangeEnd == dateTimeStamp? " cal-dateRangeEnd": "") + (this.isToday(dateTimeStamp)? " cal-today":"") + (this.isWithinDateRange(dateTimeStamp)? " cal-withinDateRange":"") + "'><button data-timestamp='" + dateTimeStamp + "'>" + i + "</button></td>";
				}

				if (++dayOfMonth % 7 === 0 && i !== this.daysInMonth) {
					html += "</tr><tr>";
				}
			}

			for (i = dayOfMonth, dayInNextMonth = 1; dayOfMonth % 7 !== 0; dayOfMonth++, dayInNextMonth++) {
				html += "<td class='cal-nextMonth'>" + dayInNextMonth + "</td>";
			}

			html += "</tr></tbody></table></div>";

			this.el.innerHTML =  html;
		},

		prevMonth: function () {
			var prevMonthNum, prevYearNum;

			if (this.prevMonthEnabled()) {
				prevMonthNum = getPrevMonth(this.monthNum, this.yearNum);
				prevYearNum = getYearOfPrevMonth(this.monthNum, this.yearNum);

				this.daysInMonth = getNumDaysInMonth(prevMonthNum, prevYearNum);
				this.monthNum = prevMonthNum;
				this.yearNum = prevYearNum;

				this.generateCalUI();
			}

			return this;
		},

		nextMonth: function () {
			var nextMonthNum, nextYearNum;

			if (this.nextMonthEnabled()) {
				nextMonthNum = getNextMonth(this.monthNum, this.yearNum);
				nextYearNum = getYearOfNextMonth(this.monthNum, this.yearNum);

				this.daysInMonth = getNumDaysInMonth(nextMonthNum, nextYearNum);
				this.monthNum = nextMonthNum;
				this.yearNum = nextYearNum;

				this.generateCalUI();
			}

			return this;
		},

		prevMonthEnabled: function () {
			var prevYearNum = getYearOfPrevMonth(this.monthNum, this.yearNum),
				prevMonthNum = getPrevMonth(this.monthNum, this.yearNum),
				enabled = false;

			if (new Date(prevYearNum, prevMonthNum, getNumDaysInMonth(prevMonthNum, prevYearNum), 23, 59, 59, 999).getTime() > this.disableBefore) {
				enabled = true;
			}

			return enabled;
		},

		nextMonthEnabled: function () {
			var nextYearNum = getYearOfNextMonth(this.monthNum, this.yearNum),
				nextMonthNum = getNextMonth(this.monthNum, this.yearNum),
				enabled = false;

			if (new Date(nextYearNum, nextMonthNum, 0, 0, 0, 0, 0).getTime() < this.disableAfter) {
				enabled = true;
			}

			return enabled;
		},

		isToday: function (timeStamp) {
			if (timeStamp >= this.todayStart && timeStamp <= this.todayEnd) {
				return true;
			} else {
				return false;
			}
		},

		isWithinDateRange: function (timeStamp) {
			if ((this.dateRangeStart && this.dateRangeEnd) && timeStamp >= this.dateRangeStart && timeStamp <= this.dateRangeEnd) {
				return true;
			} else {
				return false;
			}
		},

		setRange: function (startRange, endRange) {
			if (endRange > startRange && ((this.disableBefore && endRange - ONE_DAY > this.disableBefore) || (this.disableAfter && startRange + ONE_DAY < this.disableAfter))) {
				this.dateRangeStart = startRange;
				this.dateRangeEnd = endRange;

				this.generateCalUI();
			}

			return this;
		}

	};

	return Plugin;

})();

(function () {

	var dateInput = document.getElementById("dateInput");
	var datePickerDropdown = document.getElementById("datePicker-dropdown");

	var headerDatePicker = new calendarPlugin({
		date: new Date(),
		el: document.getElementById("datePicker-header"),
		disableBefore: new Date().setHours(0, 0, 0, 0), // disable before today
		disableAfter: new Date(Date.now() + 730 * 24 * 60 * 60 * 1000).getTime(), // disable after 2 years
		onDateSelect: function (dateStamp) {
			//dateInput.value = new Date(dateStamp).toDateString();
			var selectedDate = new Date(dateStamp);

			// TODO Show a formatted date and set a hidden input
			//displayDateInput.value = selectedDate.toDateString();
			// JavaScript months are zero indexed
			dateInput.value = selectedDate.getFullYear() + "-" + (selectedDate.getMonth() + 1) + "-" + selectedDate.getDate();

			removeClass(datePickerDropdown, "datePicker-dropdown-focus");
		}
	});

	var datePickerPrevBtn = document.getElementById("datePicker-prev");
	var datePickerNextBtn = document.getElementById("datePicker-next");

	datePickerPrevBtn.addEventListener("click", function (e) {
		if (headerDatePicker.prevMonthEnabled()) {
			headerDatePicker.prevMonth();
		}
	});

	datePickerNextBtn.addEventListener("click", function (e) {
		if (headerDatePicker.nextMonthEnabled()) {
			headerDatePicker.nextMonth();
		}
	});

	// hide the calendar if click is outside the calendar or the input
	document.body.addEventListener("click", function (e) {
		var el = e.target;
		var isWithinDropdown =  hasParentWithID(el, "dateInput") || hasParentWithClass(el, "cal") || hasParentWithClass(el, "datePicker-dropdown");


		if (!isWithinDropdown) {
			removeClass(datePickerDropdown, "datePicker-dropdown-focus");
		}
	});

	dateInput.addEventListener("click", function () {
		addClass(datePickerDropdown, "datePicker-dropdown-focus");
	});

})();
