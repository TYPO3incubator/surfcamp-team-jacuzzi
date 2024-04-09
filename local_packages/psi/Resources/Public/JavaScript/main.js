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
