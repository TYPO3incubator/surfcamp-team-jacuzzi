// Sidebar Expand/Collapse Functionality

var menuToggle = document.getElementById('menu-toggle');
var siteContent = document.getElementById('site-content')
var mainNavigation = document.getElementById('mainnavigation')

menuToggle.addEventListener('click', () => {
  if (!siteContent.classList.contains('sidebar-collapse')) {
    siteContent.classList.add('sidebar-collapse')
    mainNavigation.setAttribute('aria-expanded', 'false');
  } else {
    siteContent.classList.remove('sidebar-collapse')
    mainNavigation.setAttribute('aria-expanded', 'true');
  }
})


document.addEventListener("DOMContentLoaded", function () {
  const departmentFilter = document.getElementById("departmentFilter");
  const employees = document.querySelectorAll(".employee__item");

  departmentFilter.addEventListener("change", function () {
    const selectedDepartment = this.value;

    employees.forEach(function (employee) {
      const department = employee.getAttribute("data-department");

      if (selectedDepartment === "0" || department === selectedDepartment) {
        employee.style.display = "flex";
      } else {
        employee.style.display = "none";
      }
    });
  });
});
