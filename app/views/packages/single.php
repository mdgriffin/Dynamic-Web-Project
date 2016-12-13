<?php include_once("app/views/partials/header.php"); ?>

	<h1><?php echo $this->package->getTitle(); ?></h1>

	<div class="card">

		<div class="gs">

			<div class="gs-col gs6">

				<h2>Package Details</h2>

				<p><?php echo $this->package->getDescription(); ?></p>

			</div>

			<div class="gs-col gs6">

				<h2>Make a Booking</h2>

				<form class="form" action="packages/<?php echo $this->package->getId(); ?>" method="post">

					<fieldset>
						<input type="text" name="num_guests" id="num_guests" value="<?php echo $this->booking->getNum_guests(); ?>"><!--
						--><label for="num_guests" class="form-mainLabel">Number of Guests</label>
						<?php
						if ($this->errors && isset($this->errors["num_guests"])) {
							foreach ($this->errors["num_guests"] as $error) {
						?>
								<p class="form-error"><?php echo $error; ?></p>
						<?php
							}
						}
						?>
					</fieldset>

					<fieldset class="form-datepicker">
						<input type="hidden" name="event_date" readonly id="event_date" value="">
						<input type="text" readonly id="event_date_display" value=""><!--
						--><label for="event_date" class="form-mainLabel">Event Date</label>
						<?php 	if ($this->errors && isset($this->errors["event_date"])) { ?>
							<p class="form-error"><?php echo $this->errors["event_date"]; ?></p>
						<?php } ?>

						<div class="datePicker-dropdown datePicker-dropdown-bottomLeft" id="event-datePicker-dropdown">
							<div class="datePicker" id="event_datepicker"></div>

							<button type="button" class="datePicker-btn datePicker-btn-prev" id="event-datePicker-prev"><span class="icon-left-open-big"></span></button>
							<button type="button" class="datePicker-btn datePicker-btn-next" id="event-datePicker-next"><span class="icon-right-open-big"></span></button>
						</div>

					</fieldset>

					<input type="submit" class="btn btn-primary btn-large" name="book_package" value="Book!">

				</form>

			</div><!-- gs-col -->

		</div><!-- gs -->

	</div><!-- card -->

<?php include_once("app/views/partials/footer.php"); ?>

<script type="text/javascript">
/*
(function () {

	var dateInput = document.getElementById("event_date");
	var displayDateInput = document.getElementById("event_date_display");
	var datePickerDropdown = document.getElementById("event-datePicker-dropdown");

	var startDateArr = "<?php echo $this->package->getStart_date(); ?>".split("-");
	var startDate = new Date(startDateArr[0], startDateArr[1] - 1, startDateArr[2]);

	var endDateArr = "<?php echo $this->package->getEnd_date(); ?>".split("-");
	var endDate = new Date(endDateArr[0], endDateArr[1] - 1, endDateArr[2]);
	var calStartDate = startDate > (new Date())? startDate : new Date();

	var inputDatePicker = new calendarPlugin({
		date: calStartDate,
		el: document.getElementById("event_datepicker"),
		disableBefore: calStartDate,
		disableAfter: endDate,
		onDateSelect: function (dateStamp) {
			var selectedDate = new Date(dateStamp);

			displayDateInput.value = selectedDate.toDateString();
			// JavaScript months are zero indexed
			dateInput.value = selectedDate.getFullYear() + "-" + (selectedDate.getMonth() + 1) + "-" + selectedDate.getDate();

			removeClass(datePickerDropdown, "datePicker-dropdown-focus");
		}
	});

	var datePickerPrevBtn = document.getElementById("event-datePicker-prev");
	var datePickerNextBtn = document.getElementById("event-datePicker-next");

	datePickerPrevBtn.addEventListener("click", function (e) {
		if (inputDatePicker.prevMonthEnabled()) {
			inputDatePicker.prevMonth();
		}
	});

	datePickerNextBtn.addEventListener("click", function (e) {
		if (inputDatePicker.nextMonthEnabled()) {
			inputDatePicker.nextMonth();
		}
	});

	displayDateInput.addEventListener("click", function () {
		addClass(datePickerDropdown, "datePicker-dropdown-focus");
	});

	// hide the calendar if click is outside the calendar or the input
	document.body.addEventListener("click", function (e) {
		var el = e.target;
		var isWithinDropdown =  hasParentWithID(el, "event_date_display") || hasParentWithClass(el, "cal") || hasParentWithClass(el, "datePicker-dropdown");

		if (!isWithinDropdown) {
			removeClass(datePickerDropdown, "datePicker-dropdown-focus");
		}
	});

})();
*/

<?php
if ($this->booking->getEvent_date()) {
	$date_parts = explode("-", $this->booking->getEvent_date());
	echo "var eventDate = new Date($date_parts[0], " . ((int)$date_parts[1] - 1)  . ", $date_parts[2]);";
} else {
	echo "var eventDate = new Date();";
}

	$date_parts = explode("-", $this->package->getStart_date());
	echo "var startDate = new Date($date_parts[0], " . ((int)$date_parts[1] - 1)  . ", $date_parts[2]);";

	$date_parts = explode("-", $this->package->getEnd_date());
	echo "var endDate = new Date($date_parts[0], " . ((int)$date_parts[1] - 1)  . ", $date_parts[2]);";
?>

var startDate = startDate > (new Date())? startDate : new Date();

var eventDateCalendar = new InputCalendar({
	date: eventDate,
	inputEl: document.getElementById("event_date"),
	displayInputEl: document.getElementById("event_date_display"),
	dropDownEl: document.getElementById("event-datePicker-dropdown"),
	nextBtnEl: document.getElementById("event-datePicker-next"),
	prevBtnEl: document.getElementById("event-datePicker-prev"),
	el: document.getElementById("event_datepicker"),
	disableBefore: startDate, // disable before today
	disableAfter: endDate // disable after 2 years
});

</script>
