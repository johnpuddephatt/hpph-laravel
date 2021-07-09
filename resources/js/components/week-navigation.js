/*
 ** Weekly navigation menu
 */

var weeklyNavigationMenuTrigger = document.querySelector(
  ".weekly-screenings--navigation--trigger"
);

var weeklyNavigationMenuTarget = document.querySelector(
  ".weekly-screenings--week-picker"
);

if (weeklyNavigationMenuTrigger && weeklyNavigationMenuTarget) {
  weeklyNavigationMenuTrigger.addEventListener("click", (e) => {
    weeklyNavigationMenuTrigger.classList.toggle("active");
    weeklyNavigationMenuTarget.classList.toggle("visible");
  });

  document.body.addEventListener("click", (e) => {
    if (
      !e.target.classList.contains("weekly-screenings--navigation--trigger")
    ) {
      weeklyNavigationMenuTrigger.classList.remove("active");
      weeklyNavigationMenuTarget.classList.remove("visible");
    }
  });
}

var venueMenuTrigger = document.querySelector(".whatson--venue-trigger");

var venueMenuTarget = document.querySelector(".whatson--venue-target");

if (venueMenuTrigger && venueMenuTarget) {
  venueMenuTrigger.addEventListener("click", (e) => {
    venueMenuTrigger.classList.toggle("active");
    venueMenuTarget.classList.toggle("visible");
  });

  document.body.addEventListener("click", (e) => {
    if (!e.target.classList.contains("whatson--venue-trigger")) {
      venueMenuTrigger.classList.remove("active");
      venueMenuTarget.classList.remove("visible");
    }
  });
}
